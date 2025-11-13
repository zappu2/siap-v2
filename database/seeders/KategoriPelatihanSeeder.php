<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Balai Diklat Keagamaan Denpasar',
                'id_number' => 'bdl-11',
                'kode_satker' => '',
                'kota' => '',
                'deskripsi' => 'Balai Diklat Keagamaan Denpasar',
                'description_format' => '1',
                'parent' => 0,
                'sort_order' => 780000,
                'course_count' => 0,
                'path' => '/1',
                'theme' => '',
                'visible' => true,
            ],
            [
                'nama' => 'Balai Diklat Keagamaan Semarang',
                'id_number' => 'bdl-12',
                'kode_satker' => '',
                'kota' => '',
                'deskripsi' => 'Balai Diklat Keagamaan Semarang',
                'description_format' => '1',
                'parent' => 0,
                'sort_order' => 780001,
                'course_count' => 0,
                'path' => '/2',
                'theme' => '',
                'visible' => true,
            ],
            [
                'nama' => 'Balai Diklat Keagamaan Bandung',
                'id_number' => 'bdl-13',
                'kode_satker' => '',
                'kota' => '',
                'deskripsi' => 'Balai Diklat Keagamaan Bandung',
                'description_format' => '1',
                'parent' => 0,
                'sort_order' => 780002,
                'course_count' => 0,
                'path' => '/3',
                'theme' => '',
                'visible' => true,
            ],
            [
                'nama' => 'Tahun 2023',
                'id_number' => 'th-2023',
                'kode_satker' => '',
                'kota' => '',
                'deskripsi' => 'Kategori pelatihan untuk tahun 2023',
                'description_format' => '1',
                'parent' => 0,
                'sort_order' => 780003,
                'course_count' => 0,
                'path' => '/4',
                'theme' => '',
                'visible' => false,
            ],
            [
                'nama' => 'Pelatihan Administrasi',
                'id_number' => 'adm-01',
                'kode_satker' => '',
                'kota' => '',
                'deskripsi' => 'Kategori pelatihan administrasi dan tata kelola',
                'description_format' => '1',
                'parent' => 0,
                'sort_order' => 780004,
                'course_count' => 0,
                'path' => '/5',
                'theme' => '',
                'visible' => false,
            ],
        ];

        // Clear existing data first
        \App\Models\KategoriPelatihan::truncate();

        foreach ($categories as $category) {
            \App\Models\KategoriPelatihan::create($category);
        }
    }
}
