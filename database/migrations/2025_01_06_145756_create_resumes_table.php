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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->json('vagas_interesse')->nullable();
            $table->json('experiencia_profissional')->nullable();
            $table->string('experiencia_profissional_outro')->nullable();
            $table->string('participou_selecao')->nullable();
            $table->string('participou_selecao_outro')->nullable();
            $table->string('foi_jovem_aprendiz');
            $table->string('curriculo_doc');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
