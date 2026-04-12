<?php

namespace App\Exports;

use App\Models\Job as JobModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VagasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        return JobModel::with(['company'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Empresa', 'Setor', 'Cargo', 'CBO', 'Descrição', 'Gênero',
            'Qtd Vagas', 'Vagas Preenchidas', 'Cidade', 'UF',
            'Salário', 'Dias da Semana', 'Horário', 'Benefícios',
            'Exp. Profissional', 'Informática', 'Inglês',
            'Início Contratação', 'Fim Contratação', 'Data Entrevista Empresa',
            'Dias Curso', 'Status', 'Cadastrado em',
        ];
    }

    public function map($job): array
    {
        return [
            $job->id,
            $job->company?->razao_social,
            $job->setor,
            $job->cargo,
            $job->exibirCBO(),
            $job->descricao,
            $job->genero,
            $job->qtd_vagas,
            $job->filled_positions,
            $job->cidade,
            $job->uf,
            $job->salario_formatted, // usa o accessor já existente no model
            $job->dias_semana,
            $job->horario,
            $job->beneficios,
            $job->exp_profissional,
            $job->informatica,
            $job->ingles,
            $job->data_inicio_contratacao?->format('d/m/Y'),
            $job->data_fim_contratacao?->format('d/m/Y'),
            $job->data_entrevista_empresa?->format('d/m/Y'),
            $job->dias_curso,
            $job->status,
            $job->created_at?->format('d/m/Y H:i'),
        ];
    }
}