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
            $table->integer('jumlah_isi_evaluasi')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_klasikals', function (Blueprint $table) {
            $table->dropColumn('jumlah_isi_evaluasi');
        });
    }
};
