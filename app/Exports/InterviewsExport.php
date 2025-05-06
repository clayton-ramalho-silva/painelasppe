<?php

namespace App\Exports;

use App\Models\Interview;
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

class InterviewsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Interview::with(['resume', 'recruiter'])->get();
    }

    /**
     * Definir os títulos das colunas
     */
    public function headings(): array
    {
        return [
            'ID',
            'Recrutador',
            'Candidato',
            'Data Entrevista',
            'Saúde do Candidato',
            'Vacina COVID',
            'Perfil',
            'Perfil Santa Casa',
            'Classificação',
            'Qual a formadora? (Caso já tenha sido jovem aprendiz.)',
            'Parecer do Entrevistador',
            'Cursos Extracurriculares',
            'Apresentação Pessoal',
            'Experiência Profissional (Tempo de Empresa/Motivo da Saída)',
            'Características Positivas',
            'Habilidades',
            'Porque gostaria de ser Jovem Aprendiz?',
            'Por qual motivo pediria demissão?',
            'Pretenções do candidato',
            'Objetivos longo prazo',
            'Pontos de Melhoria',
            'Família',
            'Disponibilidade de Horário',
            'Fale um pouco sobre você',
            'Qual a sua rotina?',
            'Outros idiomas?',
            'Sua família é atendida no CRAS?',
            'Fonte de Captação do Currículo',
            'Sugestão Empresa',
            'Observações',
            'Pontuação'

        ];
    }

    /**
     * Definir o formato de cada linha
     */
    public function map($interview): array
    {
        return [
            $interview->id,
            mb_convert_encoding(optional($interview->recruiter)->name ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding(optional($interview->resume)->informacoesPessoais->nome ?? 'N/A', 'UTF-8', 'auto'),
            $interview->created_at ? $interview->created_at->format('d/m/Y') : 'N/A',
            mb_convert_encoding($interview->saude_candidato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->vacina_covid ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->perfil ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->perfil_santa_casa ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->classificacao ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->qual_formadora ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->parecer_recrutador ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->curso_extracurricular ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->apresentacao_pessoal ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->experiencia_profissional ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->caracteristicas_positivas ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->habilidades ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->porque_ser_jovem_aprendiz ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->qual_motivo_demissao ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->pretencao_candidato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->objetivo_longo_prazo ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->pontos_melhoria ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->familia ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->disponibilidade_horario ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->sobre_candidato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->rotina_candidato ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->familia_cras ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->outros_idiomas ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->fonte_curriculo ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->sugestao_empresa ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->observacoes ?? 'N/A', 'UTF-8', 'auto'),
            mb_convert_encoding($interview->pontuacao ?? 'N/A', 'UTF-8', 'auto'),
        ];
    }

    public function columnFormats(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:AE1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Verde
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
    
        // Aplicar bordas para todas as células preenchidas
        $sheet->getStyle('A1:AE100')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
