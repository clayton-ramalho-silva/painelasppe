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
        Schema::create('job_resume', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id'); // Chave estrangeira para jobs
            $table->unsignedBigInteger('resume_id'); // Chave estrangeira para resumes            
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade');

            // Garantir que cada par jog-resume é unico
            $table->unique(['job_id', 'resume_id']);                 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_resume');
    }
};
