<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailCurriculum;
use App\Models\KurikulumPelatihan;

class DetailCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first curriculum (Pelatihan Teknis Manajemen Pondok Pesantren)
        $kurikulum = KurikulumPelatihan::first();
        
        if ($kurikulum) {
            $detailData = [
                [
                    'kurikulum_pelatihan_id' => $kurikulum->id,
                    'kelompok_pelatihan' => 'Kelompok',
                    'detail_mata_pelatihan' => "Pembangunan Bidang Agama\nPengembangan Sumber Daya Manusia\nNilai-nilai Ber-Akhlak\nKonsep Dasar Manajemen Pondok Pesantren\nManajemen Pendidikan Pesantren\nManajemen Fasilitas Pondok Pesantren\nManajemen Administrasi dan Keuangan Pondok Pesantren\nManajemen Kewirausahaan Pondok Pesantren",
                    'detail_items' => [
                        ['nama_detail' => 'Pembangunan Bidang Agama', 'urutan' => 1],
                        ['nama_detail' => 'Pengembangan Sumber Daya Manusia', 'urutan' => 2],
                        ['nama_detail' => 'Nilai-nilai Ber-Akhlak', 'urutan' => 3],
                    ],
                ],
                [
                    'kurikulum_pelatihan_id' => $kurikulum->id,
                    'kelompok_pelatihan' => 'Dasar',
                    'detail_mata_pelatihan' => "Pembangunan Bidang Agama\nPengembangan Sumber Daya Manusia\nNilai-nilai Ber-Akhlak\nKonsep Dasar Manajemen Pondok Pesantren\nManajemen Pendidikan Pesantren\nManajemen Fasilitas Pondok Pesantren\nManajemen Administrasi dan Keuangan Pondok Pesantren\nManajemen Kewirausahaan Pondok Pesantren",
                    'detail_items' => [
                        ['nama_detail' => 'Pembangunan Bidang Agama', 'urutan' => 1],
                        ['nama_detail' => 'Pengembangan Sumber Daya Manusia', 'urutan' => 2],
                        ['nama_detail' => 'Nilai-nilai Ber-Akhlak', 'urutan' => 3],
                        ['nama_detail' => 'Konsep Dasar Manajemen Pondok Pesantren', 'urutan' => 4],
                        ['nama_detail' => 'Manajemen Pendidikan Pesantren', 'urutan' => 5],
                        ['nama_detail' => 'Manajemen Fasilitas Pondok Pesantren', 'urutan' => 6],
                        ['nama_detail' => 'Manajemen Administrasi dan Keuangan Pondok Pesantren', 'urutan' => 7],
                        ['nama_detail' => 'Manajemen Kewirausahaan Pondok Pesantren', 'urutan' => 8],
                    ],
                ],
                [
                    'kurikulum_pelatihan_id' => $kurikulum->id,
                    'kelompok_pelatihan' => 'Inti',
                    'detail_mata_pelatihan' => "Sistem Informasi dan Manajemen Pondok Pesantren\nPengarahan Program/Overview\nPretest\nBuilding Learning Commitment (BLC)\nPostest\nEvaluasi Program",
                    'detail_items' => [
                        ['nama_detail' => 'Sistem Informasi dan Manajemen Pondok Pesantren', 'urutan' => 1],
                        ['nama_detail' => 'Pengarahan Program/Overview', 'urutan' => 2],
                        ['nama_detail' => 'Pretest', 'urutan' => 3],
                        ['nama_detail' => 'Building Learning Commitment (BLC)', 'urutan' => 4],
                        ['nama_detail' => 'Posttest', 'urutan' => 5],
                        ['nama_detail' => 'Evaluasi Program', 'urutan' => 6],
                    ],
                ],
            ];

            foreach ($detailData as $data) {
                DetailCurriculum::create($data);
            }
        }
    }
}
