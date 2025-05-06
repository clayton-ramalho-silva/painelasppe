<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $data = [
            'cnpj' => $row['cnpj'],
            'razao_social' => $row['razao_social'],
            'nome_fantasia' => $row['nome_fantasia'],
            'status' => $row['status'],
            'email' => $row['e_mail']
        ];

        //dd($row);
       // dd('Tentando Salvar: ', $data);

        // $company = Company::firstOrCreate(['cnpj' => $data['cnpj']], $data);

        // $company->update($data);

        // Criando ou atualizando a empresa com base no CNPJ
        // $company = Company::updateOrCreate(
        //     ['cnpj' => trim($row['cnpj'] ?? '') ], // Usa o CNPJ como chave única
        //     [
        //         'razao_social'  => $row['razao_social'] ?? null,
        //         'nome_fantasia' => $row['nome_fantasia'] ?? null,                
        //         'status'        => $row['status'] ?? null,
        //     ]
        // );

        // Removendo espaços extras e garantindo que os campos essecenciais existem
        $cnpj = trim($row['cnpj'] ?? '');
        $razao_social = trim($row['razao_social'] ?? '');

        if(empty($cnpj) || empty($razao_social)){
            return null;
        }

        $company = Company::updateOrCreate(['cnpj' => $cnpj],[            
            'razao_social' => $razao_social,
            'nome_fantasia' => trim($row['nome_fantasia']),
            'status' => trim($row['status']),
        ]);

        $companies = Company::all();
        //dd($data);


        // Criando ou atualizando os contatos da empresa
        if($company->exists){
            // Criando ou atualizando os contatos da empresa via relação
            $company->contacts()->updateOrCreate( [],[                 
                'telefone'      => trim($row['telefone']),
                'email'         => trim($row['e_mail']),
                'nome_contato'  => trim($row['nome_contato']),
                'whatsapp'      => trim($row['whatsapp']),
            
            ]);

            // Criando ou atualizando a localização da empresa via relação
            $company->location()->updateOrCreate([],[
                    'logradouro'        => trim($row['rua']),
                    'numero'            => trim($row['numero']),
                    'complemento'       => trim($row['complemento']),
                    'bairro'            => trim($row['bairro']),
                    'cidade'            => trim($row['cidade']),
                    'uf'                => trim($row['uf']),
                    'cep'               => trim($row['cep']),
                    'pais'              => trim($row['pais']),
                ]
            );
        }

        return $company;
    }
}
