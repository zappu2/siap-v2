<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PelatihanWebinar;

class PelatihanWebinarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelatihanData = [
            [
                'nama' => 'CONFERENCE AND EXPOSE ON TRAINING "IMPACTFUL AND JOYFUL LEARNING"',
                'sertifikat_url' => null,
                'sertifikat_filename' => 'syafii-sign-cert-1724036455.pdf',
                'sertifikat_size' => '418 KB',
            ],
            [
                'nama' => 'Seminar Rutin Untuk ASN Inspiratif (SERASI) Seri 5 - "Empowered Women, Sustainable Future: Karir Hebat, Lingkungan Sehat"',
                'sertifikat_url' => null,
                'sertifikat_filename' => 'syafii-sign-cert-1724036455.pdf',
                'sertifikat_size' => '418 KB',
            ],
        ];

        foreach ($pelatihanData as $data) {
            PelatihanWebinar::create($data);
        }
    }
}
