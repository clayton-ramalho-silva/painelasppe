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
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['curriculos', 'empresas', 'vagas', 'entrevistas']);
            $table->enum('status', ['pending', 'processing', 'ready', 'failed', 'downloaded'])->default('pending');
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('file_size')->nullable()->comment('Tamanho em bytes');
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
