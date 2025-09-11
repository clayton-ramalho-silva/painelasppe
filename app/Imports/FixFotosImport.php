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

class FixFotosImport implements ToModel

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
        $resumes = [];
        if ($cpf) {

            $check = Resume::whereHas('informacoesPessoais', function ($query) use ($cpf) {
                $query->where('cpf', $cpf);
            })->get();

            if ($check) {
                Log::info('Linha ' . 11 . ' - Curriculo encontrado(cpf) - ' . ucwords($row[2]));
                $resumes = $check;
            } else {
                Log::info('Linha ' . 11 . ' - Não encontrei(cpf) - ' . ucwords($row[2]));
                Log::info("cpf = $cpf");
            }
        }



        if (count($resumes) == 0) {

            $check2 = Resume::whereHas('informacoesPessoais', function ($query) use ($firstName, $data_nascimento) {
                $query->where('nome', 'like', $firstName . '%')->where('data_nascimento', $data_nascimento);
            })->get();

            if ($check2->count() > 0) {
                Log::info('Linha ' . 12 . ' - Curriculo encontrado(nome e data de nascimento!) - ' . ucwords($row[2]));
                // return null;

                $resumes = $check2;
            } else {
                Log::info('Linha ' . 12 . ' - Não encontrei(nome e data de nascimento) - ' . ucwords($row[2]));
                Log::info("nome LIKE '$firstName%' AND data_nascimento = '$data_nascimento'");
            }
        }

        // dd($resume);
        if (count($resumes) == 0) {
            Log::info('Linha ' . 13 . ' - Não foi possível encontrar o candidato para atualizar a foto - ' . ucwords($row[2]));
            return null;
        } else {
            Log::info('Linha ' . 9 . ' - Candidato encontrado! - ' . ucwords($row[2]));

            foreach ($resumes as $resume) {
                Log::info('ID do Currículo: ' . $resume->id);
                if ($row[0] || str_contains($resume->codigo_unico, '.')) {
                    $resume->codigo_unico = $row[0] ?? null;
                    $resume->save();
                }
                $personalInfo = $resume->informacoesPessoais;
                if ($personalInfo->foto_candidato_externa == null && $row[38] != null && $row[38] != '') {
                    Log::info('Linha ' . 10 . ' - Candidato encontrado e foto atualizada! - ' . ucwords($row[2]));
                    $personalInfo->foto_candidato_externa = $row[38];
                    $personalInfo->save();
                }

                return $resume;
            }
        }
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
