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

class UsersImport implements ToModel

{
    private function parseToArray($value, $json_format = false)
    {
        // Remove espaços em branco e divide a string por vírgulas
        $array = array_map('trim', explode(',', $value));
        // Remove valores vazios do array
        if ($json_format) {
            if ($value == null || $value == '') {
                return '[""]';
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
            Log::info('====* Iniciando importação de currículos *====');
            // dd($row);
            return null; // Ignorar a linha de cabeçalho
        }

        if (!empty($row[56])) {
            return null; // Ignorar linhas vazias
        }
        // dd('aq');

        Log::info('Linha ' . $row[0] . ' - Iniciando importação do currículo: ' . $row[2]);
        // dd($row[0], $row);

        //Verificar pelo link do currículo externo se já existe.
        if ($row[98] && $row[98] != '') {
            $check = Resume::where('curriculo_externo', $row[98])->first();
            // dd($check);
            if ($check) {
                Log::info('Linha ' . $row[0] . ' - Ignorado(curriculo externo).');
                return null;
            }
        }

        //Verificar pelo email se já existe.
        if ($row[57] && $row[57] != '') {
            $checkEmail = Resume::whereHas('contato', function ($query) use ($row) {
                $query->where('email', $row[57]);
            })->first();
            if ($checkEmail) {
                Log::info('Linha ' . $row[0] . ' - Ignorado(email).');
                return null;
            }
        }

        $resume = Resume::create([
            'vagas_interesse' => $this->parseToArray($row[85]),
            'experiencia_profissional' => $this->parseToArray($row[86]),
            'experiencia_profissional_outro' => $this->limparString(substr($row[87], 0, 255)) ?? null,
            'foi_jovem_aprendiz' => $row[95] ?? null,
            'cras' => $row[96] ?? $row[41] ?? null,
            'fonte' => $this->limparString(substr($row[97], 0, 255)) ?? null,
            'curriculo_externo' => $row[98] ?? null,
            'autorizacao_uso_dados' => isset($row[99]) ? 1 : 0,
            'autorizacao_uso_dados' => $data['autorizacao_uso_dados'] ?? 1,
            'imported_at' => date('Y-m-d H:i:s') ?? null,
            'status' => 'ativo',
            'participou_selecao' => '',
            'participou_selecao_outro' => '',
            'curriculo_doc' => null,
            'codigo_unico' => $row[0] ?? null,
            // 'autorizacao_responsavel_menor' => $data['autorizacao_responsavel_menor'] ?? 1,
        ]);



        $resume->informacoesPessoais()->create([
            'nome' => ucwords($row[2]) ?? null,
            'data_nascimento' => $row[4] ? (is_string($row[4]) ? null : Date::excelToDateTimeObject($row[4])->format('Y-m-d')) : null,
            'estado_civil' => $row[64] ?? null,
            'possui_filhos' => $row[66] ?? null,
            'filhos_qtd' => $row[67] ?? null,
            'filhos_sim' => $row[68] ?? null,
            'sexo' => $row[69] ?? $row[42] ?? null,
            'sexo_outro' => $row[70] ?? null,
            'reservista' => $row[65] ?? $row[24] ?? null,
            'reservista_outro' => null,
            'cnh' => $row[60] ?? $row[50] ?? null,
            'tipo_cnh' => $row[61] ? str_replace([' ', 'e', 'E'], '', $row[61]) : null,
            'rg' => $row[58] ? str_replace(['-', '.'], '', $row[58]) : null,
            'cpf' => $row[59] ? str_replace(['-', '.'], '', $row[59]) : ($row[52] ? str_replace(['-', '.'], '', $row[52]) : null),
            'instagram' => $row[80] ?? null,
            'linkedin' => $row[81] ?? null,
            'tamanho_uniforme' => null,
            'pcd' => $row[71] ?? null,
            'pcd_sim' => $row[72] ?? null,
            'nacionalidade' => $row[63] ?? null
        ]);

        $resume->contato()->create([
            'email' => $row[57] ?? null,
            'telefone_residencial' => $this->limparString(substr(($row[83] ? $row[83] : $row[5]) ?? null, 0, 255)),
            'nome_contato' => $row[84] ?? null,
            'telefone_celular' => $row[82] ?? null,
            'logradouro' => $row[74] ?? null,
            'numero' => $row[75] ?? null,
            'complemento' => $row[76] ?? null,
            'bairro' => $row[77] ?? null,
            'cidade' => $row[78] ?? null,
            'uf' => $row[79] ?? null,
            'cep' => $row[73] ? str_replace(['-', '.'], '', $row[73]) : null,

        ]);


        //TODO: Verificar se está tudo ok aqui
        //if () {} // Não consegui identificar qual campo usar para saber se a entrevista aconteceu ou não.
        $resume->escolaridade()->create([
            'escolaridade' => $row[88] ?? $row[19] ?? null, // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
            'escolaridade_outro' => $this->limparString(substr($row[91] ?? $row[20] ?? null, 0, 255)), // Qual curso Outro
            'semestre' => $row[90] ?? null, // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
            'instituicao' => $row[92] ?? null, // Quando for Superior Incompleto ou Outro
            'outro_periodo' => $row[89] ?? null,
            'informatica' => $row[93] ?? $row[17] ?? null,
            'obs_informatica' => null,
            'ingles' => $row[94] ?? $row[18] ?? null,
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

        //Adicionar a interview
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
            'recruiter_id' => 1,
            //'perfil' => $data['perfil'],
            //'curso_extracurricular' => $data['curso_extracurricular'],
            //'pretencao_candidato' => $data['pretencao_candidato'],
            //'sugestao_empresa' => $data['sugestao_empresa'],
            //'sobre_candidato' => $data['sobre_candidato'],
            //'pontuacao' => $data['pontuacao'],
        ]);

        return $resume;
    }
}
