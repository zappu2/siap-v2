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
        Schema::table('peserta_pelatihans', function (Blueprint $table) {
            $table->string('sertifikat_filename')->nullable();
            $table->string('sertifikat_size')->nullable();
            $table->string('sertifikat_tte_filename')->nullable();
            $table->string('nilai_kualifikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_pelatihans', function (Blueprint $table) {
            $table->dropColumn([
                'sertifikat_filename', 
                'sertifikat_size', 
                'sertifikat_tte_filename', 
                'nilai_kualifikasi'
            ]);
        });
    }
};
