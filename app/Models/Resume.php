<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInfoResume;

class Resume extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'vagas_interesse' => 'array',
        'experiencia_profissional' => 'array',
        'created_at'               => 'datetime',  // garante objeto Carbon
        'updated_at'               => 'datetime',               
    ];

    protected $dates = ['data_nascimento'];

    // protected $fillable = [
    //     'vagas_interesse', 
    //     'experiencia_profissional','experiencia_profissional_outro', 
    //     'participou_selecao', 'participou_selecao_outro', 'foi_jovem_aprendiz', 
    //     'curriculo_doc', 'status','created_at', 'codigo_unico', 'curriculo_externo',
    //     'cras', 'fonte', 'autorizacao_uso_dados', 'autorizacao_responsavel_menor' 
    // ];

    protected $guarded = [];

    // Relacionamento muitos para muitos com Job - Vagas que o candidato está associado.
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_resume', 'resume_id', 'job_id')
            ->withTimestamps();            
            
    }

    public function informacoesPessoais()
    {
        return $this->hasOne(PersonalInfoResume::class)
            ->withDefault([
                'nome' => null,                
                'cpf' => null,
                'rg' => null,
                'data_nascimento' => null,
                'sexo' => null,
                'sexo_outro' => null,
                'estado_civil' => null,
                'nacionalidade' => null,
                'possui_filhos' => null,
                'filhos_sim' => null,
                'filhos_qtd' => null,
                'cnh' => null,
                'tipo_cnh' => null,
                'pcd' => null,
                'pcd_sim' => null,
                'reservista' => null,
                'reservista_outro' => null,
                'instagram' => null,
                'linkedin' => null,
                'tamanho_uniforme' => null,
                'foto_candidato' => null,
                'foto_candidato_externa' => null
            ]);
    }

    public function escolaridade()
    {
        return $this->hasOne(AcademicInfoResume::class, 'resume_id')
            ->withDefault([
                'escolaridade' => null,
                'informatica' => null,
                'obs_informatica' => null,
                'ingles' => null,
                'obs_ingles' => null,
                'fundamental_periodo' => null,
                'fundamental_modalidade' => null,
                'fundamental_data_conclusao' => null,
                'medio_periodo' => null,
                'medio_modalidade' => null,
                'medio_data_conclusao' => null,
                'tecnico_curso' => null,
                'tecnico_semestre' => null,
                'tecnico_instituicao' => null,
                'tecnico_modalidade' => null,
                'tecnico_periodo' => null,
                'superior_curso' => null,
                'superior_instituicao' => null,
                'superior_periodo' => null,
                'superior_semestre' => null,
                'escolaridade_outro' => null,
                'curso' => null,
                'instituicao' => null,
                'situacao_atual' => null,
                'ano_conclusao' => null,
                'semestre' => null,
                'outro_periodo' => null,
                'escolaridade_outro' => null
            ]);
    }

    public function contato()
    {
        return $this->hasOne(ContactResume::class)
            ->withDefault([
                'email' => null,
                'telefone_residencial' => null,
                'nome_contato' => null,
                'telefone_celular' => null,
                'logradouro' => null,
                'numero' => null,
                'complemento' => null,
                'bairro' => null,
                'cidade' => null,
                'uf' => null,
                'cep' => null
            ]);
    }

   public function interview()
    {
        return $this->hasOne(Interview::class)->latestOfMany()
            ->withDefault([
                'saude_candidato' => null,
                'vacina_covid' => null,
                'perfil' => null,
                'perfil_santa_casa' => null,
                'classificacao' => null,
                'qual_formadora' => null, 
                'parecer_recrutador' => null, 
                'curso_extracurricular' => null, 
                'apresentacao_pessoal' => null, 
                'experiencia_profissional' => null, 
                'caracteristicas_positivas' => null, 
                'habilidades' => null, 
                'porque_ser_jovem_aprendiz' => null, 
                'qual_motivo_demissao' => null, 
                'pretencao_candidato' => null, 
                'objetivo_longo_prazo' => null, 
                'pontos_melhoria' => null, 
                'familia' => null, 
                'disponibilidade_horario' => null, 
                'sobre_candidato' => null, 
                'rotina_candidato' => null, 
                'familia_cras' => null,
                'outros_idiomas' => null, 
                'fonte_curriculo' => null,
                'sugestao_empresa' => null, 
                'observacoes' => null, 
                'pontuacao' => null,                      
                'resume_id' => $this->id,
                'recruiter_id' => null,
                'created_at' => now(),
                'obs_rh' => null,
                'renda_familiar' => null,
                'tipo_beneficio' => null
            ]);
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

    public function observacoes()
    {
        return $this->hasMany(HistoryResume::class);
    }   


}
