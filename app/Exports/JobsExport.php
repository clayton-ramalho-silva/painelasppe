<?php

namespace App\Exports;

use App\Models\Job;
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

class JobsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Job::with(['company', 'recruiters'])->get();
    }


    /**
     * Definir os títulos das colunas
     */
    public function headings(): array
    {
        return [
            'ID',
            'Empresa',
            'Setor',
            'CBO',
            'Atividades Esperadas',
            'Genêro',
            'Quantidade de Vagas',
            'Cidade',
            'UF',
            'Salário',
            'Dias da Semana',
            'Horário',
            'Dia, Hora e Modalidade de Curso',
            'Benefícios',
            'Requisitos/Diferenciais',
            'Conhecimento Informática',
            'Conhecimento Inglês',
            'Status',
            'Recrutador',
            'Data Início Contratação',
            'Data Fim Contratação'
        ];
    }

    /**
     * Definir o formato de cada linha
     */
    public function map($job): array
    {
        return [
            $job->id,
            mb_convert_encoding(optional($job->company)->nome_fantasia ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->cargo ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->cbo ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->descricao ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->genero ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->qtd_vagas ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->cidade ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->uf ?? 'N/A', 'UTF-8', 'auto'),
            is_numeric($job->salario) ? (float) $job->salario : null,
            //mb_convert_encoding($job->salario ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->dias_semana ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->horario ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->dias_curso ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->exp_profissional ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->beneficios ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->informatica ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->ingles ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($job->status ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($job->recruiters->first())->name ?? 'N/A', 'UTF-8', 'auto'),
            $job->data_inicio_contratacao ? $job->data_inicio_contratacao->format('d/m/Y') : 'N/A',
            $job->data_fim_contratacao ? $job->data_inicio_contratacao->format('d/m/Y') : 'N/A',
            //$this->formatarData(optional($job->data_inicio_contratacao)),
            //$this->formatarData(optional($job->data_fim_contratacao)),


        ];
    }


    public function columnFormats(): array
    {
        return [
            'U' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'J' => '"R$" #,##0.00',
        ];
    }

    private function formatarData($data)
    {
        return $data ? \Carbon\Carbon::parse($data)->format('d/m/Y') : 'N/A';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:U1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Verde
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Aplicar bordas para todas as células preenchidas
        $sheet->getStyle('A1:U100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
