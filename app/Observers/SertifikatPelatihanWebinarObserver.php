<?php

namespace App\Observers;

use App\Models\SertifikatPelatihanWebinar;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class SertifikatPelatihanWebinarObserver
{
    protected $whatsappService;
    
    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    
    /**
     * Handle the SertifikatPelatihanWebinar "created" event.
     */
    public function created(SertifikatPelatihanWebinar $sertifikat): void
    {
        $this->sendNotification($sertifikat);
    }
    
    /**
     * Handle the SertifikatPelatihanWebinar "updated" event.
     * Only send notification if file_sertifikat or file_tte changed
     */
    public function updated(SertifikatPelatihanWebinar $sertifikat): void
    {
        // Check if certificate file was just uploaded
        if ($sertifikat->wasChanged('file_sertifikat') || $sertifikat->wasChanged('file_tte')) {
            $this->sendNotification($sertifikat);
        }
    }
    
    /**
     * Send WhatsApp notification to the participant
     */
    protected function sendNotification(SertifikatPelatihanWebinar $sertifikat): void
    {
        try {
            // Load relationships
            $peserta = $sertifikat->peserta;
            
            if (!$peserta) {
                Log::warning('Sertifikat has no peserta', ['sertifikat_id' => $sertifikat->id]);
                return;
            }
            
            $pengguna = $peserta->pengguna;
            
            if (!$pengguna) {
                Log::warning('Peserta has no pengguna', ['peserta_id' => $peserta->id]);
                return;
            }
            
            // Check if user has phone number
            if (empty($pengguna->no_telepon)) {
                Log::info('Pengguna has no phone number', ['pengguna_id' => $pengguna->id]);
                return;
            }
            
            $pelatihan = $peserta->pelatihanWebinar;
            
            // Send WhatsApp notification
            $this->whatsappService->sendCertificateNotification(
                phoneNumber: $pengguna->no_telepon,
                userName: $pengguna->nama_lengkap,
                certificateName: $pelatihan->nama ?? 'Pelatihan/Webinar',
                certificateNumber: $sertifikat->nomor_sertifikat ?? '-'
            );
            
            Log::info('WhatsApp notification sent for certificate', [
                'sertifikat_id' => $sertifikat->id,
                'pengguna_id' => $pengguna->id,
                'phone' => $pengguna->no_telepon
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp notification', [
                'sertifikat_id' => $sertifikat->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
