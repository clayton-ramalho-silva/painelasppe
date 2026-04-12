<?php

namespace App\Exports;

use App\Models\Resume;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EntrevistasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        return Resume::with([
                'informacoesPessoais',
                'contato',
                'escolaridade',
                'interview',
            ])
            ->select('id', 'created_at', 'status', 'vagas_interesse', 'experiencia_profissional', 'foi_jovem_aprendiz', 'cras', 'fonte')
            ->whereHas('interview')
            ->whereHas('informacoesPessoais', function ($q) {
                $q->whereNotNull('data_nascimento')
                  ->where('data_nascimento', '>=', now()->subYears(24)->toDateString());
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            // Currículo
            'ID', 'Cadastrado em', 'Status', 
            // Informações Pessoais
            'Nome', 'CPF', 'Data de Nascimento', 'Sexo', 'Sexo Outro', 'Estado Civil',
            'Nacionalidade', 'Possui Filhos', 'Qtd Filhos', 'CNH', 'Tipo CNH',
            'PCD', 'PCD Descrição', 'Reservista', 'Instagram', 'LinkedIn',
            // Contato
            'Email', 'Celular', 'Telefone Residencial', 'Nome Contato',
            'Logradouro', 'Número', 'Complemento', 'Bairro', 'Cidade', 'UF', 'CEP',
            // Escolaridade
            'Escolaridade', 'Curso', 'Instituição', 'Semestre', 'Situação Atual',
            'Informática', 'Inglês',
            // Currículo
            'Vagas de Interesse', 'Experiência Profissional',
            'Foi Jovem Aprendiz', 'CRAS', 'Fonte',
            // Entrevista
            'ID Entrevista','Entrevista em', 'Perfil', 'Classificação', 'Pontuação', 'Parecer Recrutador',
            'Saúde Candidato', 'Vacina COVID', 'Apresentação Pessoal',
            'Experiência Profissional (Entrev.)', 'Características Positivas', 'Habilidades',
            'Por que Jovem Aprendiz', 'Motivo Demissão', 'Pretensão Candidato',
            'Objetivo Longo Prazo', 'Pontos de Melhoria', 'Família', 'Disponibilidade Horário',
            'Sobre o Candidato', 'Rotina', 'Família CRAS', 'Outros Idiomas',
            'Fonte Currículo', 'Sugestão Empresa', 'Observações', 'Obs RH',
            'Renda Familiar', 'Tipo Benefício',
        ];
    }

    public function map($resume): array
    {
        $p = $resume->informacoesPessoais;
        $c = $resume->contato;
        $e = $resume->escolaridade;
        $i = $resume->interview;

        return [
            // Currículo
            $resume->id,
            $resume->created_at?->format('d/m/Y'),
            $resume->status,            
            // Informações Pessoais
            $p?->nome,
            $p?->cpf,
            $p?->data_nascimento,
            $p?->sexo,
            $p?->sexo_outro,
            $p?->estado_civil,
            $p?->nacionalidade,
            $p?->possui_filhos,
            $p?->filhos_qtd,
            $p?->cnh,
            $p?->tipo_cnh,
            $p?->pcd,
            $p?->pcd_sim,
            $p?->reservista,
            $p?->instagram,
            $p?->linkedin,
            // Contato
            $c?->email,
            $c?->telefone_celular,
            $c?->telefone_residencial,
            $c?->nome_contato,
            $c?->logradouro,
            $c?->numero,
            $c?->complemento,
            $c?->bairro,
            $c?->cidade,
            $c?->uf,
            $c?->cep,
            // Escolaridade
            // $e?->escolaridade,
            $this->formatArrayField($e?->escolaridade),
            $e?->curso,
            $e?->instituicao,
            $e?->semestre,
            $e?->situacao_atual,
            $e?->informatica,
            $e?->ingles,
            // Currículo            
            $this->formatArrayField($resume->vagas_interesse),
            $this->formatArrayField($resume->experiencia_profissional),
            $resume->foi_jovem_aprendiz,
            $resume->cras,
            $resume->fonte,
            // Entrevista
            $i?->id,
            $i?->created_at?->format('d/m/Y H:i'),
            $i?->perfil,
            $i?->classificacao,
            $i?->pontuacao,
            $i?->parecer_recrutador,
            $i?->saude_candidato,
            $i?->vacina_covid,
            $i?->apresentacao_pessoal,
            $i?->experiencia_profissional,
            $i?->caracteristicas_positivas,
            $i?->habilidades,
            $i?->porque_ser_jovem_aprendiz,
            $i?->qual_motivo_demissao,
            $i?->pretencao_candidato,
            $i?->objetivo_longo_prazo,
            $i?->pontos_melhoria,
            $i?->familia,
            $i?->disponibilidade_horario,
            $i?->sobre_candidato,
            $i?->rotina_candidato,
            $i?->familia_cras,
            $i?->outros_idiomas,
            $i?->fonte_curriculo,
            $i?->sugestao_empresa,
            $i?->observacoes,
            $i?->obs_rh,
            $i?->renda_familiar,
            $i?->tipo_beneficio,
        ];
    }

    private function formatArrayField(mixed $value): string
    {
        if (is_null($value)) {
            return '';
        }

        if (is_array($value)) {
            return implode(', ', $value);
        }

        // Tenta decodificar se vier como string JSON
        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return implode(', ', $decoded);
        }

        return $value;
    }
}