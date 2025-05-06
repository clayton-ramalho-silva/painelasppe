<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();           
            $table->string('saude_candidato', 255);
            $table->string('vacina_covid', 255);
            $table->string('perfil', 255);
            $table->string('perfil_santa_casa', 255);
            $table->string('classificacao', 255);
            $table->string('qual_formadora', 255);
            $table->text('parecer_recrutador');
            $table->text('curso_extracurricular');
            $table->text('apresentacao_pessoal');
            $table->text('experiencia_profissional');
            $table->text('caracteristicas_positivas');
            $table->text('habilidades');
            $table->text('porque_ser_jovem_aprendiz');
            $table->text('qual_motivo_demissao');
            $table->text('pretencao_candidato');
            $table->text('objetivo_longo_prazo');
            $table->text('pontos_melhoria');
            $table->text('familia');
            $table->text('disponibilidade_horario');
            $table->text('sobre_candidato');
            $table->text('rotina_candidato');
            $table->string('familia_cras');
            $table->text('outros_idiomas');
            $table->string('fonte_curriculo');
            $table->text('sugestao_empresa');
            $table->text('observacoes');
            $table->string('pontuacao');

            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
