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
use Illuminate\Support\Facades\Cache;

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

        if ($row[2] == null || $row[2] == '') {
            // Log::info('Linha ' . 13 . ' - Ignorando importação da entrevista por falta de nome: ' . ucwords($row[2]));
            return null;
        }

        // $validIds = Interview::whereDate('updated_at', '2025-09-06')->pluck('id');

        $validIds = Cache::remember('valid_interviews_2025-09-06', 3600, function () {
            return Interview::whereDate('updated_at', '2025-09-06')->pluck('id');
        });

        // dd($valid_ids);

        $firstName = explode(' ', $row[2])[0];
        $data_nascimento = $row[4] ? (is_string($row[4]) ? null : Date::excelToDateTimeObject($row[4])->format('Y-m-d')) : null;
        $cpf = $row[52] ? str_replace(['-', '.'], '', $row[52]) : null;

        //
        $resume = null;


        if ($cpf || ($firstName && $data_nascimento)) {
            Log::info('pesquisando');
            $resume = Resume::whereHas('informacoesPessoais', function ($query) use ($cpf, $firstName, $data_nascimento) {
                if ($cpf) {
                    $query->where('cpf', $cpf);
                } elseif ($firstName && $data_nascimento) {
                    $query->where('nome', 'like', $firstName . '%')
                        ->where('data_nascimento', $data_nascimento);
                }
            })
                ->whereHas('interviews', function ($query) use ($validIds) {
                    $query->whereIn('id', $validIds);
                })
                ->first();
        }

        $interview = null;
        if ($resume) {
            // Log::info('resume encontrado');

            Log::info('Atualizando status do resume');
            $resume->update([
                'status' => $this->getStatus($row[43] ?? null)
            ]);

            if ($resume->interview) {
                Log::info('ja tem entrevista, atualizando');
                $interview = $resume->interview;
                $interview->update([
                    'observacoes' => $row[54] ?? null,
                    'obs_rh' => $row[55] ?? null,
                    'fixed_at' => date('Y-m-d')
                ]);
            } else {
                Log::info('não tem entrevista');
            }
        } else {
            Log::info('resume não encontrado');
        }

        return $interview;
    }

    private function getStatus($status)
    {
        switch (trim($status)) {
            case "ATIVO":
                return 'ativo';
            case "INATIVO":
                return 'inativo';
            case "EFETIVADO":
                return 'contratado';
            default:
                return 'ativo';
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
