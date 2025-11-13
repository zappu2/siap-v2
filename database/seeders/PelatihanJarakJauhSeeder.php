<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PelatihanJarakJauh;

class PelatihanJarakJauhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelatihanData = [
            [
                // Basic info
                'nama' => 'PJU Badan Moderasi Beragama dan Pengembangan Sumber Daya Manusia',
                'display_name' => 'PJU Badan Moderasi Beragama dan Pengembangan Sumber Daya Manusia',
                'short_name' => 'PJU-BMBPSDM',
                'course_category' => 'moderasi-beragama',
                'kategori_order' => 1,
                'id_number' => 'PJU001',
                
                // Content
                'summary' => 'Pelatihan Jarak Jauh Badan Moderasi Beragama dan Pengembangan Sumber Daya Manusia Kementerian Agama RI.',
                'summary_format' => 1,
                'news_items' => 3,
                
                // Schedule
                'tanggal_mulai' => '2024-01-15',
                'tanggal_akhir' => '2024-01-20',
                
                // Advanced settings
                'group_mode' => 0,
                'visible' => true,
                
                // Legacy fields
                'nama_pelatihan' => 'PJU Badan Moderasi Beragama RI (BMB RI)',
                'penyelenggara' => 'BMB',
                'tanggal_selesai' => '2024-01-20',
                'deskripsi' => 'Pelatihan Jarak Jauh untuk Badan Moderasi Beragama Republik Indonesia mengenai pembangunan toleransi dan kerukunan antar umat beragama.',
                'terlihat' => true,
            ],
            [
                // Basic info
                'nama' => 'Pelatihan Kepala Urusan Agama Islam',
                'display_name' => 'Pelatihan Kepala Urusan Agama Islam',
                'short_name' => 'KUAI-2024',
                'course_category' => 'manajemen-kepemimpinan',
                'kategori_order' => 2,
                'id_number' => 'KUAI002',
                
                // Content
                'summary' => 'Program pelatihan untuk meningkatkan kompetensi Kepala Urusan Agama Islam di seluruh Indonesia.',
                'summary_format' => 1,
                'news_items' => 5,
                
                // Schedule
                'tanggal_mulai' => '2024-02-10',
                'tanggal_akhir' => '2024-02-15',
                
                // Advanced settings
                'group_mode' => 1,
                'visible' => true,
                
                // Legacy fields
                'nama_pelatihan' => 'Pelatihan Kepala Urusan Agama Islam',
                'penyelenggara' => 'Kemenag',
                'tanggal_selesai' => '2024-02-15',
                'deskripsi' => 'Program pelatihan untuk meningkatkan kompetensi Kepala Urusan Agama Islam di seluruh Indonesia.',
                'terlihat' => true,
            ],
            [
                // Basic info
                'nama' => 'Diklat Teknis Pengelolaan Zakat',
                'display_name' => 'Diklat Teknis Pengelolaan Zakat',
                'short_name' => 'ZAKAT-TKN',
                'course_category' => 'teknis-fungsional',
                'kategori_order' => 3,
                'id_number' => 'ZKT003',
                
                // Content
                'summary' => 'Pelatihan teknis untuk pengelolaan zakat yang efektif dan transparan sesuai dengan standar nasional.',
                'summary_format' => 1,
                'news_items' => 2,
                
                // Schedule
                'tanggal_mulai' => '2024-03-05',
                'tanggal_akhir' => '2024-03-12',
                
                // Advanced settings
                'group_mode' => 0,
                'visible' => false,
                
                // Legacy fields
                'nama_pelatihan' => 'Diklat Teknis Pengelolaan Zakat',
                'penyelenggara' => 'BAZNAS',
                'tanggal_selesai' => '2024-03-12',
                'deskripsi' => 'Pelatihan teknis untuk pengelolaan zakat yang efektif dan transparan sesuai dengan standar nasional.',
                'terlihat' => false,
            ],
        ];

        foreach ($pelatihanData as $data) {
            PelatihanJarakJauh::create($data);
        }
    }
}
