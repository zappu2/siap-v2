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
        Schema::create('peserta_pelatihan_webinar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->unsignedBigInteger('pelatihan_webinar_id');
            $table->date('tanggal_daftar');
            $table->enum('status_kelulusan', ['Belum Selesai', 'Lulus', 'Tidak Lulus'])->default('Belum Selesai');
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('pengguna');
            $table->foreign('pelatihan_webinar_id')->references('id')->on('pelatihan_webinars');
            
            $table->unique(['pengguna_id', 'pelatihan_webinar_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_pelatihan_webinar');
    }
};
