<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SertifikatPelatihanWebinar;
use App\Models\PesertaPelatihanWebinar;
use App\Models\PelatihanWebinar;
use App\Models\Pengguna;

class TestCertificateNotification extends Command
{
    protected $signature = 'test:certificate-notification';
    protected $description = 'Test certificate WhatsApp notification by creating a dummy certificate';

    public function handle()
    {
        $this->info('Testing Certificate WhatsApp Notification System');
        $this->newLine();
        
        // Check if we have test data
        $pengguna = Pengguna::whereNotNull('no_telepon')->first();
        
        if (!$pengguna) {
            $this->error('No pengguna with phone number found!');
            $this->info('Please add a phone number to a pengguna record first.');
            return Command::FAILURE;
        }
        
        $this->info("Found pengguna: {$pengguna->nama_lengkap}");
        $this->info("Phone: {$pengguna->no_telepon}");
        $this->newLine();
        
        // Get or create a webinar
        $webinar = PelatihanWebinar::first();
        
        if (!$webinar) {
            $this->error('No webinar found! Please seed the database first.');
            return Command::FAILURE;
        }
        
        $this->info("Using webinar: {$webinar->nama}");
        $this->newLine();
        
        // Create or get peserta
        $peserta = PesertaPelatihanWebinar::firstOrCreate(
            [
                'pengguna_id' => $pengguna->id,
                'pelatihan_webinar_id' => $webinar->id,
            ],
            [
                'tanggal_daftar' => now(),
                'status_kelulusan' => 'Lulus'
            ]
        );
        
        $this->info('Peserta created/found');
        $this->newLine();
        
        // Create a certificate (this should trigger the observer)
        $this->info('Creating certificate... (This should trigger WhatsApp notification)');
        
        $sertifikat = SertifikatPelatihanWebinar::create([
            'peserta_pelatihan_webinar_id' => $peserta->id,
            'nomor_sertifikat' => 'TEST-' . now()->format('YmdHis'),
            'tanggal_terbit' => now(),
            'file_sertifikat' => 'test-certificate.pdf',
            'file_tte' => 'test-certificate-tte.pdf',
        ]);
        
        $this->newLine();
        $this->info('✓ Certificate created with ID: ' . $sertifikat->id);
        $this->info('✓ Certificate number: ' . $sertifikat->nomor_sertifikat);
        $this->newLine();
        
        $this->info('Check your WhatsApp for the notification!');
        $this->info('Also check logs: storage/logs/laravel.log');
        $this->newLine();
        
        $this->warn('Cleaning up test data...');
        $sertifikat->delete();
        $this->info('✓ Test certificate deleted');
        
        return Command::SUCCESS;
    }
}
