<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agama;
use App\Models\PangkatGolongan;
use App\Models\Pendidikan;
use App\Models\UnitKerja;
use App\Models\Provinsi;
use App\Models\KabKota;
use App\Models\Role;
use App\Models\Pengguna;

class EssentialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create basic Agama data
        Agama::create(['nama' => 'Islam']);
        Agama::create(['nama' => 'Kristen']);
        Agama::create(['nama' => 'Hindu']);
        Agama::create(['nama' => 'Buddha']);

        // Create basic Pangkat Golongan
        PangkatGolongan::create(['nama_pangkat' => 'Pembina', 'golongan' => 'IV/a']);
        PangkatGolongan::create(['nama_pangkat' => 'Penata Tingkat I', 'golongan' => 'III/d']);
        PangkatGolongan::create(['nama_pangkat' => 'Penata', 'golongan' => 'III/c']);

        // Create basic Pendidikan
        Pendidikan::create(['jenjang' => 'S1', 'keterangan' => 'Sarjana']);
        Pendidikan::create(['jenjang' => 'S2', 'keterangan' => 'Magister']);
        Pendidikan::create(['jenjang' => 'SMA', 'keterangan' => 'Sekolah Menengah Atas']);

        // Create basic Unit Kerja
        UnitKerja::create(['nama' => 'Badan Pengembangan SDM', 'kode_unit' => 'BPSDM']);
        UnitKerja::create(['nama' => 'Pusat Pelatihan', 'kode_unit' => 'PUSLAT']);

        // Create basic Provinsi
        Provinsi::create(['nama' => 'DKI Jakarta', 'kode_provinsi' => '31']);
        Provinsi::create(['nama' => 'Jawa Barat', 'kode_provinsi' => '32']);

        // Create basic Kab/Kota
        KabKota::create(['nama' => 'Jakarta Pusat', 'kode_kabkota' => '3171', 'provinsi_id' => 1]);
        KabKota::create(['nama' => 'Jakarta Selatan', 'kode_kabkota' => '3174', 'provinsi_id' => 1]);

        // Create basic Role
        Role::create(['nama_role' => 'Super Admin', 'deskripsi' => 'Administrator sistem']);
        Role::create(['nama_role' => 'Admin', 'deskripsi' => 'Administrator']);
        Role::create(['nama_role' => 'User', 'deskripsi' => 'Pengguna biasa']);

        // Create Admin User in Pengguna table
        Pengguna::create([
            'nip' => '198001012000011001',
            'nama_lengkap' => 'Administrator Sistem',
            'name' => 'Administrator Sistem', // For Filament compatibility
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama_id' => 1,
            'status_kawin' => 'Kawin',
            'alamat' => 'Jakarta',
            'provinsi_id' => 1,
            'kab_kota_id' => 1,
            'no_telepon' => '081234567890',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'pangkat_golongan_id' => 1,
            'pendidikan_id' => 1,
            'unit_kerja_id' => 1,
            'jabatan' => 'Administrator',
            'role_id' => 1,
            'is_active' => true,
        ]);

        echo "Essential data seeded successfully!\n";
        echo "Admin credentials:\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n";
    }
}