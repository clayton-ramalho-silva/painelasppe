<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\Company;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        // Removendo espaços extras dos campos essenciais
        // Verificando se o company_id está presente
        $company_id = trim($row['company_id'] ?? '');
        if(empty($company_id)){
            \Log::error("Importação falhou: Company ID ausente na linha " . json_encode($row));
            return null;
        }

        // Buscar a empresa pelo CNPJ
        $company = Company::find($company_id);

         // Se a empresa não existir, registrar o erro e ignorar a linha
        if (!$company) {
            \Log::error("Empresa não encontrada para o ID: {$company_id}");
            return null; // Ignorar a linha em vez de gerar erro
        }

        // Verificar se o campo cargo está preenchido
        $cargo = trim($row['setor'] ?? ''); // O Label é setor mas a coluna no banco é cargo mesmo.

        if(empty($cargo)){
            \Log::warning("Cargo vazio na importação para empresa ID: {$company_id}");
            return null;
        }

        
        //dd($company);
                
        $job = Job::create(
            [
                'company_id'    => $company->id,
                'cargo'         => $cargo,            
                'setor' => '',
                'cbo' => trim($row['cbo']) ?? 'N/A',
                'descricao' => trim($row['atividades_esperadas']) ?? 'N/A',
                'genero' => trim($row['genero']) ?? 'N/A',
                'qtd_vagas' => trim($row['quantidade_vagas']) ?? 'N/A',
                'cidade' => trim($row['cidade']) ?? 'N/A',
                'uf' => trim($row['uf']) ?? 'N/A',
                'salario' => isset($row['salario']) ? floatval($row['salario']) : null,
                'dias_semana' => trim($row['dias_da_semana']) ?? 'N/A',
                'horario' => trim($row['horario']) ?? 'N/A',
                'dias_curso' => trim($row['dia_hora_e_modalidade_de_curso']) ?? 'N/A',
                'beneficios' => trim($row['beneficios']) ?? 'N/A',
                'exp_profissional' => trim($row['requisitos_diferenciais']) ?? 'N/A',
                'informatica' => trim($row['conhecimento_informatica']) ?? 'N/A',
                'ingles' => trim($row['conhecimento_ingles']) ?? 'N/A',
                'status' => trim($row['status']) ?? 'N/A',
                'data_inicio_contratacao' => isset($row['data_inicio_contratacao']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $row['data_inicio_contratacao']) : null,
                'data_fim_contratacao' => isset($row['data_fim_contratacao']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $row['data_fim_contratacao']) : null,                      

            ]
        );

        // Associando recrutador à vaga, se existir
        $recruiter_id = trim($row['recrutador']) ?? '';
        if(!empty($recruiter_id)){
            $recruiter = User::find($recruiter_id);
            if ($recruiter) {
                $job->recruiters()->attach($recruiter_id);
            } else {
                \Log::warning("Recrutador ID: {$recruiter_id} não encontrado. Ignorado.");
            }
        }

        return $job;


    }
}
