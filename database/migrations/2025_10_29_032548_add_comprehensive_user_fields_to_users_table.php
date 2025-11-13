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
        Schema::table('users', function (Blueprint $table) {
            // Data Pribadi fields
            $table->string('nama_lengkap')->nullable()->after('name');
            $table->string('agama')->nullable()->after('nama_lengkap');
            $table->string('pangkat_golongan')->nullable()->after('agama');
            $table->date('tmt_jabatan')->nullable()->after('jabatan');
            $table->date('tmt_cpns')->nullable()->after('tmt_jabatan');
            $table->date('tmt_pangkat')->nullable()->after('tmt_cpns');
            $table->string('tempat_lahir')->nullable()->after('tmt_pangkat');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('tanggal_lahir');
            $table->text('pendidikan')->nullable()->after('jenis_kelamin');
            
            // Alamat fields
            $table->string('alamat_rumah_1')->nullable()->after('pendidikan');
            $table->string('alamat_rumah_2')->nullable()->after('alamat_rumah_1');
            $table->string('provinsi')->nullable()->after('alamat_rumah_2');
            $table->string('kab_kota')->nullable()->after('provinsi');
            $table->string('kode_pos')->nullable()->after('kab_kota');
            $table->string('nomor_handphone')->nullable()->after('kode_pos');
            $table->text('alamat_kantor')->nullable()->after('nomor_handphone');
            $table->string('telepon_kantor')->nullable()->after('alamat_kantor');
            
            // Data Keuangan fields
            $table->string('nama_bank')->nullable()->after('telepon_kantor');
            $table->string('no_rekening')->nullable()->after('nama_bank');
            $table->string('nama_di_bank')->nullable()->after('no_rekening');
            $table->string('npwp')->nullable()->after('nama_di_bank');
            
            // Roles field
            $table->json('roles')->nullable()->after('npwp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nama_lengkap', 'agama', 'pangkat_golongan', 'tmt_jabatan', 'tmt_cpns', 
                'tmt_pangkat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'pendidikan',
                'alamat_rumah_1', 'alamat_rumah_2', 'provinsi', 'kab_kota', 'kode_pos',
                'nomor_handphone', 'alamat_kantor', 'telepon_kantor', 'nama_bank', 
                'no_rekening', 'nama_di_bank', 'npwp', 'roles'
            ]);
        });
    }
};
