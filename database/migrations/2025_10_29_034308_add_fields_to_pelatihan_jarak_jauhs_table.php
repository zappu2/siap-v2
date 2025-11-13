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
        Schema::table('pelatihan_jarak_jauhs', function (Blueprint $table) {
            $table->string('nama_pelatihan')->after('id');
            $table->string('penyelenggara')->after('nama_pelatihan');
            $table->date('tanggal_mulai')->after('penyelenggara');
            $table->date('tanggal_selesai')->after('tanggal_mulai');
            $table->text('deskripsi')->nullable()->after('tanggal_selesai');
            $table->boolean('terlihat')->default(true)->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihan_jarak_jauhs', function (Blueprint $table) {
            $table->dropColumn([
                'nama_pelatihan', 'penyelenggara', 'tanggal_mulai', 
                'tanggal_selesai', 'deskripsi', 'terlihat'
            ]);
        });
    }
};
