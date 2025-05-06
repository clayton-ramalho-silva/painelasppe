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
        Schema::create('academic_info_resumes', function (Blueprint $table) {
            $table->id();
            $table->string('escolaridade');
            $table->string('escolaridade_outro')->nullable();
            $table->string('informatica');
            $table->string('ingles');
            $table->foreignId('resume_id')->constrained('resumes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_info_resumes');
    }
};
