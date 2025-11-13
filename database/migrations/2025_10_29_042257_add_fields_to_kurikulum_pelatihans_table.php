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
            $table->text('nama_pelatihan')->nullable();
            $table->string('jenis_pelatihan')->nullable();
            $table->string('jam_pelajaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kurikulum_pelatihans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pelatihan',
                'jenis_pelatihan',
                'jam_pelajaran',
            ]);
        });
    }
};
