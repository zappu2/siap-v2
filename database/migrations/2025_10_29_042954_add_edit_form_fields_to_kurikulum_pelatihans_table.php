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
        Schema::table('kurikulum_pelatihans', function (Blueprint $table) {
            $table->text('kompetensi')->nullable();
            $table->text('catatan')->nullable();
            $table->text('sertifikat_depan')->nullable();
            $table->text('sertifikat_belakang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kurikulum_pelatihans', function (Blueprint $table) {
            $table->dropColumn([
                'kompetensi',
                'catatan',
                'sertifikat_depan',
                'sertifikat_belakang',
            ]);
        });
    }
};
