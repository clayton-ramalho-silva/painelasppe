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
        Schema::create('personal_info_resumes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('estado_civil');
            $table->string('possui_filhos');
            $table->string('sexo');
            $table->string('reservista');
            $table->string('reservista_outro');
            $table->string('rg');
            $table->string('cpf');
            $table->string('tamanho_uniforme');
            $table->foreignId('resume_id')->constrained('resumes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_info_resumes');
    }
};
