<?php

namespace App\Exports;

use App\Models\User;
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

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * Definir os títulos das colunas
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'E-mail',
            'Função',
            'Status'
        ];
    }

    /**
     * Definir o formato de cada linha
     */
    public function map($user): array
    {
        return [
            $user->id,
            mb_convert_encoding($user->name ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($user->email ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($user->role ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($user->status ? 'Ativo': 'Inativo', 'UTF-8', 'auto'),


        ];
    }

    public function columnFormats(): array
    {
        return [ ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Verde
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Aplicar bordas para todas as células preenchidas
        $sheet->getStyle('A1:E100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
