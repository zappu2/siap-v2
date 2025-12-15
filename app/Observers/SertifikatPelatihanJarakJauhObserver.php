<?php

namespace App\Observers;

use App\Models\SertifikatPelatihanJarakJauh;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class SertifikatPelatihanJarakJauhObserver
{
    protected $whatsappService;
    
    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    
    /**
     * Handle the SertifikatPelatihanJarakJauh "created" event.
     */
    public function created(SertifikatPelatihanJarakJauh $sertifikat): void
    {
        $this->sendNotification($sertifikat);
    }
    
    /**
     * Handle the SertifikatPelatihanJarakJauh "updated" event.
     */
    public function updated(SertifikatPelatihanJarakJauh $sertifikat): void
    {
        if ($sertifikat->wasChanged('file_sertifikat') || $sertifikat->wasChanged('file_tte')) {
            $this->sendNotification($sertifikat);
        }
    }
    
    /**
     * Send WhatsApp notification to the participant
     */
    protected function sendNotification(SertifikatPelatihanJarakJauh $sertifikat): void
    {
        try {
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
            
            if (empty($pengguna->no_telepon)) {
                Log::info('Pengguna has no phone number', ['pengguna_id' => $pengguna->id]);
                return;
            }
            
            $pelatihan = $peserta->pelatihanJarakJauh;
            
            $this->whatsappService->sendCertificateNotification(
                phoneNumber: $pengguna->no_telepon,
                userName: $pengguna->nama_lengkap,
                certificateName: $pelatihan->nama_pelatihan ?? 'Pelatihan Jarak Jauh',
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
