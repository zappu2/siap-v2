<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LookupDataSeeder::class,
            UserSeeder::class,
            CourseCategorySeeder::class,
            KategoriPelatihanSeeder::class,
            PelatihanJarakJauhSeeder::class,
            PelatihanKlasikalSeeder::class,
            PelatihanWebinarSeeder::class,
            KurikulumPelatihanSeeder::class,
            DetailCurriculumSeeder::class,
            PesertaPelatihanSeeder::class,
        ]);
    }
}
