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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama_lengkap');
            $table->string('name')->nullable(); // For Filament compatibility
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->unsignedBigInteger('agama_id');
            $table->enum('status_kawin', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->text('alamat');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kab_kota_id');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('pangkat_golongan_id');
            $table->unsignedBigInteger('pendidikan_id');
            $table->unsignedBigInteger('unit_kerja_id');
            $table->string('jabatan');
            $table->string('foto_profil')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->string('tanda_tangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('agama_id')->references('id')->on('agamas');
            $table->foreign('pangkat_golongan_id')->references('id')->on('pangkat_golongans');
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans');
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerja');
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->foreign('kab_kota_id')->references('id')->on('kab_kota');
            $table->foreign('role_id')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
