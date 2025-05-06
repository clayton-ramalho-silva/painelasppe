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
        Schema::table('personal_info_resumes', function (Blueprint $table) {
            $table->string('foto_candidato')->nullable(); // Campo preenchido no form
            $table->string('foto_candidato_externa')->nullable(); // Link para foto no google docs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_info_resumes', function (Blueprint $table) {
            $table->dropColumn('foto_candidato');
            $table->dropColumn('foto_candidato_externa');
        });
    }
};
