<?php

namespace App\Imports;

use App\Models\Interview;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Row;
// use Maatwebsite\Excel\Concerns\OnEachRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InterviewImport implements ToModel

{
    private function parseToArray($value, $json_format = false)
    {
        // Remove espaços em branco e divide a string por vírgulas
        $array = array_map('trim', explode(',', $value));
        // Remove valores vazios do array
        if ($json_format) {
            if ($value == null || $value == '') {
                return [""];
            }
            return array_filter($array) ? json_encode(array_filter($array)) : null;
        }
        return array_filter($array);
    }

    private function limparString($string)
    {
        // Remove caracteres de controle e não imprimíveis
        $string = preg_replace('/[\x00-\x1F\x7F]/', '', $string);

        // Converte para UTF-8 válido
        $string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');

        // Remove espaços extras
        $string = trim($string);

        return $string;
    }

    public function model(array $row)
    {
        if ($row[0] == "Código Único") {
            Log::info('====* Iniciando importação de entrevistas *====');
            // dd($row);
            return null; // Ignorar a linha de cabeçalho
        }

        $firstName = explode(' ', $row[2])[0];
        $data_nascimento = $row[4] ? (is_string($row[4]) ? null : Date::excelToDateTimeObject($row[4])->format('Y-m-d')) : null;
        $cpf = $row[52] ? str_replace(['-', '.'], '', $row[52]) : null;

        //
        $resume = null;
        if ($cpf) {

            $check = Resume::whereHas('informacoesPessoais', function ($query) use ($cpf) {
                $query->where('cpf', $cpf);
            })->first();
            Log::info('Linha ' . 11 . ' - Curriculo Ignorado(cpf) - ' . ucwords($row[2]));

            if ($check) {
                $resume = $check;
            }
            Log::info('Linha ' . 11 . ' - Não encontrei(cpf) - ' . ucwords($row[2]));
            Log::info("cpf = $cpf");
        }



        if ($resume == null) {

            $check2 = Resume::whereHas('informacoesPessoais', function ($query) use ($firstName, $data_nascimento) {
                $query->where('nome', 'like', $firstName . '%')->where('data_nascimento', $data_nascimento);
            })->get();

            if ($check2->count() > 0) {
                Log::info('Linha ' . 12 . ' - Curriculo Ignorado(nome e data de nascimento!) - ' . ucwords($row[2]));
                // return null;

                $resume = $check2->first();
            } else {
                Log::info('Linha ' . 11 . ' - Não encontrei(nome e data de nascimento) - ' . ucwords($row[2]));
                Log::info("nome LIKE '$firstName%' AND data_nascimento = '$data_nascimento'");
            }
        }

        if ($resume == null) { // Cadastrar nova inscrição quando não achar nenhuma inscrição vinculada

            Log::info('Linha ' . 10 . ' - Iniciando importação do currículo(novo): ' . ucwords($row[2]));

            $resume = Resume::create([
                'vagas_interesse' => null,
                'experiencia_profissional' => $this->parseToArray($row[25] ?? null),
                'experiencia_profissional_outro' => null,
                'foi_jovem_aprendiz' => $row[15] ?? null,
                'cras' => $row[41] ?? null,
                'fonte' => $this->limparString(substr($row[48], 0, 255)) ?? null,
                'curriculo_externo' => $row[39] ?? null,
                'autorizacao_uso_dados' => 1,
                'imported_at' => date('Y-m-d H:i:s') ?? null,
                'status' => 'ativo',
                'participou_selecao' => '',
                'participou_selecao_outro' => '',
                'curriculo_doc' => null,
                'codigo_unico' => $row[0] ?? null,
                'autorizacao_responsavel_menor' => 1,
            ]);

            $resume->informacoesPessoais()->create([
                'nome' => ucwords($row[2]) ?? null,
                'data_nascimento' => $row[4] ? (is_string($row[4]) ? null : Date::excelToDateTimeObject($row[4])->format('Y-m-d')) : null,
                'estado_civil' => null,
                'possui_filhos' => null,
                'filhos_qtd' => null,
                'filhos_sim' => null,
                'sexo' => $row[42] ?? null,
                'sexo_outro' => null,
                'reservista' => $row[24] ?? null,
                'reservista_outro' => null,
                'cnh' => $row[50] ?? null,
                'tipo_cnh' => null,
                'rg' => null,
                'cpf' => $row[52] ? str_replace(['-', '.'], '', $row[52]) : null,
                'instagram' => null,
                'linkedin' => null,
                'tamanho_uniforme' => null,
                'pcd' => null,
                'pcd_sim' => null,
                'nacionalidade' => null
            ]);

            $resume->contato()->create([
                'email' => null,
                'telefone_residencial' => $this->limparString(substr($row[5] ?? null, 0, 255)),
                'nome_contato' => null,
                'telefone_celular' => null,
                'logradouro' => $row[6] ?? null,
                'numero' => null,
                'complemento' => null,
                'bairro' => $row[8] ?? null,
                'cidade' => $row[7] ?? null,
                'uf' => null,
                'cep' => null,

            ]);

            $resume->escolaridade()->create([ // 88
                'escolaridade' => $row[19] ?? null, // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
                'escolaridade_outro' => $this->limparString(substr($row[20] ?? null, 0, 255)), // Qual curso Outro
                'semestre' => null, // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
                'instituicao' => null, // Quando for Superior Incompleto ou Outro
                'outro_periodo' => null,
                'informatica' => $row[17] ?? null,
                'obs_informatica' => null,
                'ingles' => $row[18] ?? null,
                'obs_ingles' => null,
                'fundamental_periodo' => null,
                'fundamental_modalidade' => null,
                'medio_periodo' => null,
                'medio_modalidade' => null,
                'tecnico_periodo' => null,
                'tecnico_modalidade' => null,
                'tecnico_curso' => null,
                'superior_curso' => null, // Curso
                'superior_instituicao' => null,
                'superior_semestre' => null, // Modalidade
                'superior_periodo' => null, // Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.
            ]);
        }

        Log::info('Linha ' . 10 . ' - Iniciando importação da entrevista: ' . ucwords($row[2]));

        $interview =  Interview::create([
            'outros_idiomas' => $row[46] ?? null,
            'apresentacao_pessoal' => $row[23] ?? null,
            'saude_candidato' => $row[9] ?? null,
            'qual_formadora' => $row[16] ?? null,
            'vacina_covid' => $row[10] ?? null,
            'experiencia_profissional' => $row[25] ?? null,
            'qual_motivo_demissao' => $row[29] ?? null,
            'caracteristicas_positivas' => $row[26] ?? null,
            'habilidades' => $row[27] ?? null,
            'pontos_melhoria' => $row[32] ?? null,
            'rotina_candidato' => $row[40] ?? null,
            'disponibilidade_horario' => $row[36] ?? null,
            'familia' => $row[33] ?? null,
            'renda_familiar' => $row[51] ?? null,
            'familia_cras' => $row[41] ?? null,
            'tipo_beneficio' => null,
            'objetivo_longo_prazo' => $row[31] ?? null,
            'porque_ser_jovem_aprendiz' => $row[47] ?? null,
            'fonte_curriculo' => $row[48] ?? null,
            'perfil_santa_casa' => $row[12] ?? null,
            'classificacao' => $row[13] ?? null,
            'parecer_recrutador' => $row[21] ?? null,
            'observacoes' => $row[55] ?? null,
            'obs_rh' => null,
            'resume_id' => $resume->id,
            'recruiter_id' => $this->buscarIDRecrutador($row[35] ?? null),
            //'perfil' => $data['perfil'],
            //'curso_extracurricular' => $data['curso_extracurricular'],
            //'pretencao_candidato' => $data['pretencao_candidato'],
            //'sugestao_empresa' => $data['sugestao_empresa'],
            //'sobre_candidato' => $data['sobre_candidato'],
            //'pontuacao' => $data['pontuacao'],
        ]);


        return $interview;
    }


    private function buscarIDRecrutador($nome)
    {
        $nome = strtoupper(trim($nome));
        switch ($nome) {
            case 'caroline':
                $id = 18;
                break;
            case 'marina':
                $id = 36;
                break;
            case 'danielle':
                $id = 35;
                break;
            case 'marcel':
                $id = 34;
                break;
            case 'tânia':
                $id = 28;
                break;
            case 'surya':
                $id = 27;
                break;
            case 'mônica':
                $id = 24;
                break;
            case 'marina':
                $id = 22;
                break;
            case 'hevelyn':
                $id = 20;
                break;
            case 'luciana':
                $id = 13;
                break;
            case 'fernanda':
                $id = 12;
                break;
            case 'nayara':
                $id = 11;
                break;

            default:
                $id = 18; // Recrutador não encontrado
        }

        return $id;
    }
}
