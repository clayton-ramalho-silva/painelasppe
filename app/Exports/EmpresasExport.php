<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmpresasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        return Company::with(['location', 'contacts'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'CNPJ', 'Razão Social', 'Nome Fantasia', 'Status', 'Observação', 'Cadastrado em',
            // Localização
            'Logradouro', 'Número', 'Complemento', 'Bairro', 'Cidade', 'UF', 'CEP',
            // Contato
            'Email', 'Telefone', 'Ramal', 'WhatsApp', 'Nome Contato',
        ];
    }

    public function map($company): array
    {
        $l = $company->location;
        $c = $company->contacts;

        return [
            // Empresa
            $company->id,
            $company->cnpj,
            $company->razao_social,
            $company->nome_fantasia,
            $company->status,
            $company->observacao,
            $company->created_at?->format('d/m/Y H:i'),
            // Localização
            $l?->logradouro,
            $l?->numero,
            $l?->complenento,   // typo original preservado — nome real da coluna no banco
            $l?->bairro,
            $l?->cidade,
            $l?->uf,
            $l?->cep,
            // Contato
            $c?->email,
            $c?->telefone,
            $c?->ramal,
            $c?->whatsapp,
            $c?->nome_contato,
        ];
    }
}