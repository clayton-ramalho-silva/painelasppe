<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CompaniesExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::with(['contacts', 'location'])->get();
    }

    /**
     * Definir os títulos das colunas
     */
    public function headings(): array
    {
        return [
            'ID',
            'CNPJ',
            'Razão Social',
            'Nome Fantasia',
            'Status',
            'Telefone',
            'E-mail',
            'Nome Contato',
            'Whatsapp',
            'Rua',
            'Número',
            'Complemento',
            'Bairro',
            'Cidade',
            'UF',
            'CEP',
            'País',
        ];
    }

    /**
     * Definir o formato de cada linha
     */
    public function map($company): array
    {
        return [
            $company->id,
            mb_convert_encoding($company->cnpj ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($company->razao_social ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($company->nome_fantasia ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($company->status ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->contacts)->telefone ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->contacts)->email ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->contacts)->nome_contato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->contacts)->whatsapp ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->logradouro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->numero ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->complenento ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->bairro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->cidade ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->uf ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->cep ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($company->location)->pais ?? 'N/A', 'UTF-8', 'auto'),
            
        ];
    }

    public function columnFormats(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Q1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Verde
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Aplicar bordas para todas as células preenchidas
        $sheet->getStyle('A1:Q100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
