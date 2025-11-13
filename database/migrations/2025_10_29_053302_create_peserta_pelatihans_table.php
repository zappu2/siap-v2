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
        Schema::create('peserta_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelatihan_klasikal_id');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('nip');
            $table->string('no_hp');
            $table->string('diklat_yang_diikuti');
            $table->timestamps();
            
            $table->foreign('pelatihan_klasikal_id')->references('id')->on('pelatihan_klasikals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_pelatihans');
    }
};
