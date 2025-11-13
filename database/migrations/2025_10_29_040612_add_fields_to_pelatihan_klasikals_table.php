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
        Schema::table('pelatihan_klasikals', function (Blueprint $table) {
            $table->text('nama')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->date('tanggal_pelaksanaan_mulai')->nullable();
            $table->date('tanggal_pelaksanaan_selesai')->nullable();
            $table->integer('peserta')->default(0);
            $table->boolean('verifikasi')->default(false);
            $table->boolean('selesai')->default(false);
            $table->boolean('bisa_ditandatangani')->default(false);
            $table->integer('tahun_pelaksanaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_klasikals', function (Blueprint $table) {
            $table->dropColumn([
                'nama',
                'penyelenggara',
                'tanggal_pelaksanaan_mulai',
                'tanggal_pelaksanaan_selesai',
                'peserta',
                'verifikasi',
                'selesai',
                'bisa_ditandatangani',
                'tahun_pelaksanaan',
            ]);
        });
    }
};
