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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // Ação: create, update, delete
            $table->string('table_name'); // Nome da tabela onde ocorreu a ação
            $table->unsignedBigInteger('record_id'); // ID do registro afetado
            $table->text('description')->nullable(); // Descrição da ação
            $table->unsignedBigInteger('user_id')->nullable(); // Usuário que realizou a ação
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
