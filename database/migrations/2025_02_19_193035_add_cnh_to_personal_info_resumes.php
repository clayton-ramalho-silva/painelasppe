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
            $table->string('cnh')->after('reservista_outro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_info_resumes', function (Blueprint $table) {
            $table->dropColumn('cnh');
        });
    }
};
