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
        Schema::table('job_recruiter', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('recruiter_id')
                ->constrained('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_recruiter', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\User::class, 'user_id');
            $table->dropColumn('user_id');
        });
    }
};
