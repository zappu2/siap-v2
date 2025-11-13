<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PesertaPelatihan;
use App\Models\PelatihanKlasikal;

class PesertaPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first training (Uji Kompetensi Widyaiswara di Bandung)
        $pelatihan = PelatihanKlasikal::where('nama', 'Uji Kompetensi Widyaiswara di Bandung')->first();
        
        if ($pelatihan) {
            PesertaPelatihan::create([
                'pelatihan_klasikal_id' => $pelatihan->id,
                'foto' => null, // Will use default avatar
                'nama' => 'Basma Graha Nashorinal, S.T.',
                'nip' => '199008062023211021',
                'no_hp' => '081282982893',
                'diklat_yang_diikuti' => 'Uji Kompetensi Widyaiswara di Bandung',
                'sertifikat_filename' => 'basma-graha-nashorinal-certificate-1748337123.pdf',
                'sertifikat_size' => '161 KB',
                'sertifikat_tte_filename' => null,
                'nilai_kualifikasi' => 'Cukup',
            ]);
        }
    }
}
