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

class ResumeImport implements ToModel

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
        if ($row[0] == "Carimbo de data/hora") {
            Log::info('====* Iniciando importação de inscrições *====');
            // dd($row);
            return null; // Ignorar a linha de cabeçalho
        }

        $createResume = true;

        $firstName = explode(' ', $row[2])[0];
        $data_nascimento = $row[7] ? (is_string($row[7]) ? null : Date::excelToDateTimeObject($row[7])->format('Y-m-d')) : null;
        $rg = str_replace(['-', '.'], '', $row[3]);

        //
        if ($rg) {

            $check = Resume::whereHas('informacoesPessoais', function ($query) use ($firstName, $data_nascimento, $rg) {
                $query->where('nome', 'like', $firstName . '%')->where('data_nascimento', $data_nascimento)
                    ->orWhere('rg', $rg);
            })->get();

            if ($check->count() >= 1) {
                Log::info('Linha ' . 1 . ' - Ignorado(nome e data nascimento ou RG).');
                // return null;
                $createResume = false;

                // $resume = $check->first();
            }
        } else {
            $check = Resume::whereHas('informacoesPessoais', function ($query) use ($firstName, $data_nascimento, $rg) {
                $query->where('nome', 'like', $firstName . '%')->where('data_nascimento', $data_nascimento);
            })->get();

            if ($check->count() >= 1) {
                Log::info('Linha ' . 1 . ' - Ignorado(nome e data nascimento).');
                // return null;
                $createResume = false;

                // $resume = $check->first();
            }
        }

        /*$check = Resume::whereHas('informacoesPessoais', function ($query) use ($firstName, $data_nascimento) {
            $query->where('nome', 'like', $firstName . '%')->where('data_nascimento', $data_nascimento);
        })->get();

        if ($check->count() == 1) {
            Log::info('Linha ' . 1 . ' - Ignorado(nome e data nascimento).');
            // return null;
            $createResume = false;

            // $resume = $check->first();
        }
        if ($check->count() > 1) {
            Log::info('Linha ' . 1 . ' - Não Ignorado(resultando inconsistente).');
            Log::info("data_nascimento = '$data_nascimento' AND nome LIKE " . '"' . $firstName . '%"');

            // TODO: Verificar se nos resultados de $check o campo de RG são iguais, se sim, não criar o currículo
            // Coleta todos os RGs dos resultados
            $rgs = $check->pluck('informacoesPessoais.rg')->filter()->unique();

            // Se todos os RGs são iguais (só existe 1 RG único), não criar o currículo
            if ($rgs->count() == 1) {
                Log::info('Linha ' . 2 . ' - Ignorado(RGs iguais nos resultados múltiplos).');
                $createResume = false;
            } else {
                Log::info('Linha ' . 2 . ' - Criando currículo(RGs diferentes nos resultados múltiplos).');
                $createResume = true;
            }


            // $createResume = true;
        }*/

        // dd($createResume);

        // dd($row[0], $row);

        if ($createResume) {
            Log::info('Linha ' . 0 . ' - Iniciando importação do currículo: ' . ucwords($row[2]));

            $resume = Resume::create([
                'vagas_interesse' => $this->parseToArray($row[30] ?? null),
                'experiencia_profissional' => $this->parseToArray($row[31] ?? null),
                'experiencia_profissional_outro' => isset($row[32]) ? $this->limparString(substr($row[32] ?? null, 0, 255)) : null,
                'foi_jovem_aprendiz' => $row[40] ?? null,
                'cras' => $row[41] ?? null,
                'fonte' => $this->limparString(substr($row[42], 0, 255)) ?? null,
                'curriculo_externo' => $row[43] ?? null,
                'autorizacao_uso_dados' => isset($row[44]) ? 1 : 0,
                'imported_at' => date('Y-m-d H:i:s') ?? null,
                'status' => 'ativo',
                'participou_selecao' => '',
                'participou_selecao_outro' => '',
                'curriculo_doc' => null,
                'codigo_unico' => $row[0] ?? null,
                'autorizacao_responsavel_menor' => isset($row[44]) ? 1 : 0,
            ]);

            $resume->informacoesPessoais()->create([
                'nome' => ucwords($row[2]) ?? null,
                'data_nascimento' => $row[7] ? (is_string($row[7]) ? null : Date::excelToDateTimeObject($row[7])->format('Y-m-d')) : null,
                'estado_civil' => $row[9] ?? null,
                'possui_filhos' => $row[11] ?? null,
                'filhos_qtd' => $row[12] ?? null,
                'filhos_sim' => $row[13] ?? null,
                'sexo' => $row[14] ?? null,
                'sexo_outro' => $row[15] ?? null,
                'reservista' => $row[10] ?? null,
                'reservista_outro' => null,
                'cnh' => $row[5] ?? null,
                'tipo_cnh' => $row[6] ? str_replace([' ', 'e'], '', $row[6]) : null,
                'rg' => $row[3] ? str_replace(['-', '.'], '', $row[3]) : null,
                'cpf' => $row[4] ? str_replace(['-', '.'], '', $row[4]) : null,
                'instagram' => $row[25] ?? null,
                'linkedin' => $row[26] ?? null,
                'tamanho_uniforme' => null,
                'pcd' => $row[16] ?? null,
                'pcd_sim' => $row[17] ?? null,
                'nacionalidade' => $row[8] ?? null
            ]);

            $resume->contato()->create([
                'email' => $row[1] ?? null,
                'telefone_residencial' => $this->limparString(substr($row[28] ?? null, 0, 255)),
                'nome_contato' => $row[29] ?? null,
                'telefone_celular' => $this->limparString(substr($row[27] ?? null, 0, 255)),
                'logradouro' => $row[19] ?? null,
                'numero' => $row[20] ?? null,
                'complemento' => $row[21] ?? null,
                'bairro' => $row[22] ?? null,
                'cidade' => $row[23] ?? null,
                'uf' => $row[24] ?? null,
                'cep' => $row[18] ? str_replace(['-', '.'], '', $row[18]) : null,

            ]);

            $resume->escolaridade()->create([ // 88
                'escolaridade' => $row[33] ?? null, // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
                'escolaridade_outro' => $this->limparString(substr($row[36] ?? null, 0, 255)), // Qual curso Outro
                'semestre' => $row[35] ?? null, // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
                'instituicao' => $row[37] ?? null, // Quando for Superior Incompleto ou Outro
                'outro_periodo' => $row[34] ?? null,
                'informatica' => $row[38] ?? null,
                'obs_informatica' => null,
                'ingles' => $row[39] ?? null,
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
            return $resume;
        }
    }
}
