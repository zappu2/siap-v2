<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PelatihanKlasikal;

class PelatihanKlasikalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelatihanData = [
            [
                'nama' => 'Uji Kompetensi Widyaiswara di Bandung',
                'penyelenggara' => 'Pusbangkom MKMB',
                'tanggal_pelaksanaan_mulai' => '2025-04-14',
                'tanggal_pelaksanaan_selesai' => '2025-04-16',
                'peserta' => 1,
                'verifikasi' => false,
                'selesai' => false,
                'bisa_ditandatangani' => false,
                'tahun_pelaksanaan' => 2025,
                'jenis_pelatihan' => 'Pelatihan Ukom',
                'kurikulum' => 'Uji Kompetensi WI Kehumasan',
                'tahun' => 2025,
                'id_diklat' => 'UJI-2025-001',
                'penandatangan_sertifikat' => 'SYAFII - Kepala Pusbangkom Manajemen, Kepemimpinan dan Moderasi Beragama',
                'terlihat' => true,
                'jumlah_isi_evaluasi' => 0,
            ],
            [
                'nama' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan III',
                'penyelenggara' => 'Balai Diklat Keagamaan Provinsi Aceh',
                'tanggal_pelaksanaan_mulai' => '2023-09-10',
                'tanggal_pelaksanaan_selesai' => '2023-09-13',
                'peserta' => 34,
                'verifikasi' => true,
                'selesai' => true,
                'bisa_ditandatangani' => true,
                'tahun_pelaksanaan' => 2023,
                'jenis_pelatihan' => 'Orientasi PPPK',
                'kurikulum' => '2',
                'tahun' => 2023,
                'id_diklat' => 'PPPK-2023-001',
                'penandatangan_sertifikat' => 'Kepala Balai Diklat',
                'terlihat' => true,
                'jumlah_isi_evaluasi' => 15,
            ],
            [
                'nama' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan I',
                'penyelenggara' => 'Balai Diklat Keagamaan Provinsi Aceh',
                'tanggal_pelaksanaan_mulai' => '2023-09-10',
                'tanggal_pelaksanaan_selesai' => '2023-09-13',
                'peserta' => 33,
                'verifikasi' => true,
                'selesai' => true,
                'bisa_ditandatangani' => true,
                'tahun_pelaksanaan' => 2023,
                'jenis_pelatihan' => 'Orientasi PPPK',
                'kurikulum' => '2',
                'tahun' => 2023,
                'id_diklat' => 'PPPK-2023-002',
                'penandatangan_sertifikat' => 'Kepala Balai Diklat',
                'terlihat' => true,
                'jumlah_isi_evaluasi' => 12,
            ],
            [
                'nama' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan II',
                'penyelenggara' => 'Balai Diklat Keagamaan Provinsi Aceh',
                'tanggal_pelaksanaan_mulai' => '2023-09-10',
                'tanggal_pelaksanaan_selesai' => '2023-09-13',
                'peserta' => 35,
                'verifikasi' => true,
                'selesai' => true,
                'bisa_ditandatangani' => true,
                'tahun_pelaksanaan' => 2023,
            ],
            [
                'nama' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan I',
                'penyelenggara' => 'Balai Diklat Keagamaan Padang',
                'tanggal_pelaksanaan_mulai' => '2023-09-12',
                'tanggal_pelaksanaan_selesai' => '2023-09-15',
                'peserta' => 40,
                'verifikasi' => true,
                'selesai' => true,
                'bisa_ditandatangani' => true,
                'tahun_pelaksanaan' => 2023,
            ],
            [
                'nama' => 'Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan I',
                'penyelenggara' => 'Balai Diklat Keagamaan Palembang',
                'tanggal_pelaksanaan_mulai' => '2023-09-12',
                'tanggal_pelaksanaan_selesai' => '2023-09-15',
                'peserta' => 38,
                'verifikasi' => true,
                'selesai' => true,
                'bisa_ditandatangani' => true,
                'tahun_pelaksanaan' => 2023,
            ],
            [
                'nama' => 'Pelatihan Kepemimpinan Administrator (PKA) Angkatan I',
                'penyelenggara' => 'Balai Diklat Keagamaan Bandung',
                'tanggal_pelaksanaan_mulai' => '2024-01-15',
                'tanggal_pelaksanaan_selesai' => '2024-01-25',
                'peserta' => 25,
                'verifikasi' => false,
                'selesai' => false,
                'bisa_ditandatangani' => false,
                'tahun_pelaksanaan' => 2024,
            ],
            [
                'nama' => 'Diklat Teknis Substantif Pengelolaan Haji dan Umrah',
                'penyelenggara' => 'Balai Diklat Keagamaan Semarang',
                'tanggal_pelaksanaan_mulai' => '2024-02-20',
                'tanggal_pelaksanaan_selesai' => '2024-02-28',
                'peserta' => 30,
                'verifikasi' => true,
                'selesai' => false,
                'bisa_ditandatangani' => false,
                'tahun_pelaksanaan' => 2024,
            ],
        ];

        foreach ($pelatihanData as $data) {
            PelatihanKlasikal::create($data);
        }
    }
}
