<?php

namespace App\Exports;

use App\Models\Resume;
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
use PhpOffice\PhpSpreadsheet\Style\Font;


class ResumesExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resume::with(['informacoesPessoais', 'escolaridade', 'contato'])->get();
    }

    /**
     * Definir os títulos das colunas
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Data de Nascimento',
            'Estado Civil',
            'Possui Filhos',
            'Genêro',
            'Reservista',            
            'Cnh',
            'Rg',
            'CPF',
            'Instagram',
            'Linkedin',
            'Tamanho do Uniforme',
            'E-mail',
            'Telefone de Contato', // Telefone de contato
            'Nome de contato',
            'Telefone celular',
            'Rua',
            'Número',
            'Complemento',
            'Bairro',
            'Cidade',
            'UF',
            'CEP',
            'Formação',
            'Formação Adcional',
            'Nível informática?',
            'Nível inglês',
            'Vagas Interesse?',
            'Experiencia profissional',
            'Experiencia profissional Adcional',            
            'Já foi jovemaprendiz',
            'curriculo_doc',
            
        ];
    }

    /**
     * Definir o formato de cada linha
     */
    public function map($resume): array
    {
        //$fileUrl = $resume->curriculo_doc ? asset('documents/resumes/curriculos/' . $resume->curriculo_doc) : '';
        $url_app = 'https://painelasppe.com.br/';
        // $escolaridade = $resume->escolaridade->escolaridade;

        // if(is_string($escolaridade) && str_starts_with($escolaridade, '[')){
        //     // Tenta decodificar como JSON
        //     $decoded = json_decode($escolaridade, true);
        //     $escolaridade = is_array($decoded) ? implode(', ', $decoded) : $escolaridade;
        // }

        // $resultEscolaridade = mb_convert_encoding($escolaridade ?? 'N/A', 'UTF-8', 'auto');

        return [
            $resume->id,
            mb_convert_encoding(optional($resume->informacoesPessoais)->nome ?? 'N/A', 'UTF-8', 'auto'),
            $this->formatarData(optional($resume->informacoesPessoais)->data_nascimento),
            mb_convert_encoding(optional($resume->informacoesPessoais)->estado_civil ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->possui_filhos ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->sexo ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->reservista ?? 'N/A', 'UTF-8', 'auto'),            
            mb_convert_encoding(optional($resume->informacoesPessoais)->cnh ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->rg ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->cpf ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->instagram ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->linkedin ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->informacoesPessoais)->tamanho_uniforme ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->email ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->telefone_residencial ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->nome_contato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->telefone_celular ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->logradouro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->numero ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->complemento ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->bairro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->cidade ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->uf ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->contato)->cep ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(implode(', ', optional($resume->escolaridade)->escolaridade ?? ['N/A']), 'UTF-8', 'auto'),
            //$resultEscolaridade,
            mb_convert_encoding(optional($resume->escolaridade)->escolaridade_outro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->escolaridade)->informatica ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($resume->escolaridade)->ingles ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($resume->vagas_interesse ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($resume->experiencia_profissional ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($resume->experiencia_profissional_outro ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($resume->foi_jovem_aprendiz ?? 'N/A', 'UTF-8', 'auto'),
            $resume->curriculo_doc ? $url_app . asset('documents/resumes/curriculos/' . $resume->curriculo_doc) : 'N/A',

        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AG' => NumberFormat::FORMAT_TEXT,
        ];
    }

    private function formatarData($data)
    {
        return $data ? \Carbon\Carbon::parse($data)->format('d/m/Y') : 'N/A';
    }


    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:AG1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Verde
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Aplicar bordas para todas as células preenchidas
        $sheet->getStyle('A1:AG100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }

   
    
}
