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

class LookupDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk Agama
        $agamas = [
            ['nama' => 'Islam'],
            ['nama' => 'Kristen Protestan'],
            ['nama' => 'Kristen Katolik'],
            ['nama' => 'Hindu'],
            ['nama' => 'Buddha'],
            ['nama' => 'Konghucu'],
        ];
        foreach ($agamas as $agama) {
            Agama::create($agama);
        }

        // Seeder untuk Pangkat Golongan
        $pangkatGolongans = [
            ['nama_pangkat' => 'Juru Muda', 'golongan' => 'I/a'],
            ['nama_pangkat' => 'Juru Muda Tingkat I', 'golongan' => 'I/b'],
            ['nama_pangkat' => 'Juru', 'golongan' => 'I/c'],
            ['nama_pangkat' => 'Juru Tingkat I', 'golongan' => 'I/d'],
            ['nama_pangkat' => 'Pengatur Muda', 'golongan' => 'II/a'],
            ['nama_pangkat' => 'Pengatur Muda Tingkat I', 'golongan' => 'II/b'],
            ['nama_pangkat' => 'Pengatur', 'golongan' => 'II/c'],
            ['nama_pangkat' => 'Pengatur Tingkat I', 'golongan' => 'II/d'],
            ['nama_pangkat' => 'Penata Muda', 'golongan' => 'III/a'],
            ['nama_pangkat' => 'Penata Muda Tingkat I', 'golongan' => 'III/b'],
            ['nama_pangkat' => 'Penata', 'golongan' => 'III/c'],
            ['nama_pangkat' => 'Penata Tingkat I', 'golongan' => 'III/d'],
            ['nama_pangkat' => 'Pembina', 'golongan' => 'IV/a'],
            ['nama_pangkat' => 'Pembina Tingkat I', 'golongan' => 'IV/b'],
            ['nama_pangkat' => 'Pembina Utama Muda', 'golongan' => 'IV/c'],
            ['nama_pangkat' => 'Pembina Utama Madya', 'golongan' => 'IV/d'],
            ['nama_pangkat' => 'Pembina Utama', 'golongan' => 'IV/e'],
        ];
        foreach ($pangkatGolongans as $pangkat) {
            PangkatGolongan::create($pangkat);
        }

        // Seeder untuk Pendidikan
        $pendidikans = [
            ['jenjang' => 'SD/MI', 'keterangan' => 'Sekolah Dasar / Madrasah Ibtidaiyah'],
            ['jenjang' => 'SMP/MTs', 'keterangan' => 'Sekolah Menengah Pertama / Madrasah Tsanawiyah'],
            ['jenjang' => 'SMA/MA/SMK', 'keterangan' => 'Sekolah Menengah Atas / Madrasah Aliyah / Sekolah Menengah Kejuruan'],
            ['jenjang' => 'D1', 'keterangan' => 'Diploma 1'],
            ['jenjang' => 'D2', 'keterangan' => 'Diploma 2'],
            ['jenjang' => 'D3', 'keterangan' => 'Diploma 3'],
            ['jenjang' => 'D4/S1', 'keterangan' => 'Diploma 4 / Sarjana'],
            ['jenjang' => 'S2', 'keterangan' => 'Magister'],
            ['jenjang' => 'S3', 'keterangan' => 'Doktor'],
        ];
        foreach ($pendidikans as $pendidikan) {
            Pendidikan::create($pendidikan);
        }

        // Seeder untuk Unit Kerja
        $unitKerjas = [
            ['nama' => 'Badan Pengembangan Sumber Daya Manusia', 'kode_unit' => 'BPSDM'],
            ['nama' => 'Pusat Pelatihan dan Pengembangan', 'kode_unit' => 'PUSLAT'],
            ['nama' => 'Balai Diklat Keagamaan', 'kode_unit' => 'BDK'],
            ['nama' => 'Kantor Wilayah Kementerian Agama', 'kode_unit' => 'KANWIL'],
            ['nama' => 'Kantor Kementerian Agama Kabupaten/Kota', 'kode_unit' => 'KANKEMENAG'],
            ['nama' => 'Madrasah Tsanawiyah Negeri', 'kode_unit' => 'MTsN'],
            ['nama' => 'Madrasah Aliyah Negeri', 'kode_unit' => 'MAN'],
            ['nama' => 'Institut Agama Islam Negeri', 'kode_unit' => 'IAIN'],
            ['nama' => 'Universitas Islam Negeri', 'kode_unit' => 'UIN'],
        ];
        foreach ($unitKerjas as $unitKerja) {
            UnitKerja::create($unitKerja);
        }

        // Seeder untuk Provinsi (beberapa contoh)
        $provinsis = [
            ['nama' => 'DKI Jakarta', 'kode_provinsi' => '31'],
            ['nama' => 'Jawa Barat', 'kode_provinsi' => '32'],
            ['nama' => 'Jawa Tengah', 'kode_provinsi' => '33'],
            ['nama' => 'DI Yogyakarta', 'kode_provinsi' => '34'],
            ['nama' => 'Jawa Timur', 'kode_provinsi' => '35'],
            ['nama' => 'Banten', 'kode_provinsi' => '36'],
        ];
        foreach ($provinsis as $provinsi) {
            Provinsi::create($provinsi);
        }

        // Seeder untuk Kab/Kota (beberapa contoh untuk setiap provinsi)
        $kabKotas = [
            // DKI Jakarta
            ['nama' => 'Jakarta Pusat', 'kode_kabkota' => '3171', 'provinsi_id' => 1],
            ['nama' => 'Jakarta Utara', 'kode_kabkota' => '3172', 'provinsi_id' => 1],
            ['nama' => 'Jakarta Barat', 'kode_kabkota' => '3173', 'provinsi_id' => 1],
            ['nama' => 'Jakarta Selatan', 'kode_kabkota' => '3174', 'provinsi_id' => 1],
            ['nama' => 'Jakarta Timur', 'kode_kabkota' => '3175', 'provinsi_id' => 1],
            // Jawa Barat
            ['nama' => 'Kabupaten Bogor', 'kode_kabkota' => '3201', 'provinsi_id' => 2],
            ['nama' => 'Kabupaten Sukabumi', 'kode_kabkota' => '3202', 'provinsi_id' => 2],
            ['nama' => 'Kabupaten Cianjur', 'kode_kabkota' => '3203', 'provinsi_id' => 2],
            ['nama' => 'Kabupaten Bandung', 'kode_kabkota' => '3204', 'provinsi_id' => 2],
            ['nama' => 'Kota Bogor', 'kode_kabkota' => '3271', 'provinsi_id' => 2],
            ['nama' => 'Kota Sukabumi', 'kode_kabkota' => '3272', 'provinsi_id' => 2],
            ['nama' => 'Kota Bandung', 'kode_kabkota' => '3273', 'provinsi_id' => 2],
        ];
        foreach ($kabKotas as $kabKota) {
            KabKota::create($kabKota);
        }

        // Seeder untuk Role
        $roles = [
            ['nama_role' => 'Super Admin', 'deskripsi' => 'Administrator dengan akses penuh sistem'],
            ['nama_role' => 'Admin Pelatihan', 'deskripsi' => 'Administrator khusus pengelolaan pelatihan'],
            ['nama_role' => 'Penyelenggara', 'deskripsi' => 'Penyelenggara pelatihan dari unit kerja'],
            ['nama_role' => 'Peserta', 'deskripsi' => 'Peserta pelatihan'],
            ['nama_role' => 'Instruktur', 'deskripsi' => 'Instruktur/Pengajar pelatihan'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create Admin User in Pengguna table
        Pengguna::create([
            'nip' => '198001012000011001',
            'nama_lengkap' => 'Administrator Sistem',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama_id' => 1, // Islam
            'status_kawin' => 'Kawin',
            'alamat' => 'Jl. Administrasi No. 1, Jakarta Pusat',
            'provinsi_id' => 1, // DKI Jakarta
            'kab_kota_id' => 1, // Jakarta Pusat
            'no_telepon' => '081234567890',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'pangkat_golongan_id' => 13, // Pembina IV/a
            'pendidikan_id' => 7, // S1
            'unit_kerja_id' => 1, // BPSDM
            'jabatan' => 'Administrator Sistem',
            'role_id' => 1, // Super Admin
            'is_active' => true,
        ]);
    }
}