<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pengembangan Kompetensi',
                'slug' => 'pengembangan-kompetensi',
                'description' => 'Kategori untuk pelatihan pengembangan kompetensi pegawai',
                'is_active' => true,
            ],
            [
                'name' => 'Manajemen dan Kepemimpinan',
                'slug' => 'manajemen-kepemimpinan',
                'description' => 'Kategori untuk pelatihan manajemen dan kepemimpinan',
                'is_active' => true,
            ],
            [
                'name' => 'Teknis Fungsional',
                'slug' => 'teknis-fungsional',
                'description' => 'Kategori untuk pelatihan teknis fungsional',
                'is_active' => true,
            ],
            [
                'name' => 'Moderasi Beragama',
                'slug' => 'moderasi-beragama',
                'description' => 'Kategori untuk pelatihan moderasi beragama',
                'is_active' => true,
            ],
            [
                'name' => 'Haji dan Umrah',
                'slug' => 'haji-umrah',
                'description' => 'Kategori untuk pelatihan terkait haji dan umrah',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            CourseCategory::create($category);
        }
    }
}
