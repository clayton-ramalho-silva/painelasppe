<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $casts = [
        'data_inicio_contratacao' => 'date',
        'data_fim_contratacao' => 'date',
    ];

    protected $fillable = [
        'setor', 'cargo', 'cbo', 'descricao', 'genero',
        'qtd_vagas','filled_positions', 'cidade', 'uf',
        'salario', 'dias_semana', 'horario', 'beneficios',
        'exp_profissional', 'informatica', 'ingles', 'data_inicio_contratacao',
        'data_fim_contratacao', 'status', 'company_id', 'dias_curso'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function updateStatus()
    {
        if($this->filled_positions >= $this->qtd_vagas){
            $this->status = 'fechada';
        }elseif($this->filled_positions < $this->qtd_vagas && $this->status == 'fechada'){
            $this->status = 'aberta';
        }

        $this->save();
    }

    public function recruiters()
    {
        return $this->belongsToMany(User::class, 'job_recruiter', 'job_id', 'recruiter_id');
    }

    // Relacionamento muitos para muitos com Resume
    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'job_resume', 'job_id', 'resume_id');

    }


    // Acessar para exibir o salario formatado
    public function getSalarioFormattedAttribute()
    {
        return number_format($this->salario, 2, ',', '.'); // Exibe no formato brasileiro
    }

    // Mutator para garantir que o valor do salário é salvo corretamente
    public function setSalarioAttribute($value)
    {
        $this->attributes['salario'] = (float) str_replace(array('.',','), array('','.'), $value);
    }


    // Histórico de observações da vaga
    public function observacoes()
    {
        return $this->hasMany(HistoryJob::class);
    }

    // Relacioanmento um para muitos com Selection
    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

}
