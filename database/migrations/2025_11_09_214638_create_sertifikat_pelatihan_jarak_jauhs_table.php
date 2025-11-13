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
        Schema::create('sertifikat_pelatihan_jarak_jauh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_pelatihan_jarak_jauh_id');
            $table->string('nomor_sertifikat')->unique();
            $table->date('tanggal_terbit');
            $table->string('file_sertifikat')->nullable();
            $table->string('file_tte')->nullable();
            $table->timestamps();

            $table->foreign('peserta_pelatihan_jarak_jauh_id')->references('id')->on('peserta_pelatihan_jarak_jauh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat_pelatihan_jarak_jauh');
    }
};
