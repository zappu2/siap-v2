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
            $table->string('jenis_pelatihan')->nullable();
            $table->string('kurikulum')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('id_diklat')->nullable();
            $table->string('penandatangan_sertifikat')->nullable();
            $table->boolean('terlihat')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_klasikals', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_pelatihan',
                'kurikulum',
                'tahun',
                'id_diklat',
                'penandatangan_sertifikat',
                'terlihat',
            ]);
        });
    }
};
