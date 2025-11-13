<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KurikulumPelatihan;

class KurikulumPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kurikulumData = [
            [
                'nama_pelatihan' => 'Pelatihan Teknis Manajemen Pondok Pesantren',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '54 (lima puluh empat) JP',
            ],
            [
                'nama_pelatihan' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika',
                'jenis_pelatihan' => 'lainnya',
                'jam_pelajaran' => '20 (dua puluh) JP',
            ],
            [
                'nama_pelatihan' => 'Pelatihan Teknis Public Speaking',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '54 (lima puluh empat) JP',
            ],
            [
                'nama_pelatihan' => 'Pelatihan Karya Tulis Ilmiah',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '54 (Lima Puluh Empat) JP',
            ],
            [
                'nama_pelatihan' => 'Master Training Penguatan Moderasi Beragama',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '42 (empat puluh dua) JP',
            ],
            [
                'nama_pelatihan' => 'Pelatihan Kepemimpinan Administrator (PKA)',
                'jenis_pelatihan' => 'manajerial',
                'jam_pelajaran' => '120 (seratus dua puluh) JP',
            ],
            [
                'nama_pelatihan' => 'Diklat Teknis Substantif Pengelolaan Zakat',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '80 (delapan puluh) JP',
            ],
            [
                'nama_pelatihan' => 'Pelatihan Fungsional Penyuluh Agama',
                'jenis_pelatihan' => 'fungsional',
                'jam_pelajaran' => '60 (enam puluh) JP',
            ],
            [
                'nama_pelatihan' => 'Workshop Penguatan Kapasitas Pengawas Madrasah',
                'jenis_pelatihan' => 'teknis',
                'jam_pelajaran' => '32 (tiga puluh dua) JP',
            ],
            [
                'nama_pelatihan' => 'Seminar Nasional Toleransi Beragama',
                'jenis_pelatihan' => 'lainnya',
                'jam_pelajaran' => '16 (enam belas) JP',
            ],
        ];

        foreach ($kurikulumData as $data) {
            KurikulumPelatihan::create($data);
        }
    }
}
