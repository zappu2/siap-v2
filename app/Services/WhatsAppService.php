<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiUrl;
    protected $token;
    protected $enabled;
    
    public function __construct()
    {
        $this->apiUrl = config('services.whatsapp.api_url', 'https://api.fonnte.com/send');
        $this->token = config('services.whatsapp.token');
        $this->enabled = config('services.whatsapp.enabled', true);
    }
    
    /**
     * Send WhatsApp message
     * 
     * @param string $phoneNumber Phone number with country code (e.g., 6281234567890)
     * @param string $message Message to send
     * @return array Response from API
     */
    public function sendMessage(string $phoneNumber, string $message): array
    {
        if (!$this->enabled) {
            Log::info('WhatsApp service is disabled');
            return [
                'success' => false,
                'message' => 'WhatsApp service is disabled'
            ];
        }
        
        if (!$this->token) {
            Log::warning('WhatsApp token not configured');
            return [
                'success' => false,
                'message' => 'WhatsApp service not configured'
            ];
        }
        
        // Format phone number (remove leading 0 if exists, add 62 if needed)
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);
        
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->apiUrl, [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62', // Indonesia
            ]);
            
            $result = $response->json();
            
            Log::info('WhatsApp message sent', [
                'phone' => $phoneNumber,
                'status' => $response->successful(),
                'response' => $result
            ]);
            
            return [
                'success' => $response->successful(),
                'data' => $result
            ];
            
        } catch (\Exception $e) {
            Log::error('WhatsApp send failed', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Format phone number to international format
     * 
     * @param string $phoneNumber
     * @return string
     */
    protected function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove spaces, dashes, and other non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Remove leading 0
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }
        
        // Add country code if not present
        if (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }
        
        return $phoneNumber;
    }
    
    /**
     * Send certificate notification to user
     * 
     * @param string $phoneNumber
     * @param string $userName
     * @param string $certificateName
     * @param string $certificateNumber
     * @return array
     */
    public function sendCertificateNotification(
        string $phoneNumber,
        string $userName,
        string $certificateName,
        string $certificateNumber
    ): array {
        $message = "Halo *{$userName}*,\n\n";
        $message .= "Selamat! 🎉\n\n";
        $message .= "Sertifikat pelatihan Anda telah tersedia:\n\n";
        $message .= "📋 *Pelatihan:* {$certificateName}\n";
        $message .= "🔖 *Nomor Sertifikat:* {$certificateNumber}\n\n";
        $message .= "Anda dapat mengunduh sertifikat melalui dashboard SIAP.\n\n";
        $message .= "Terima kasih telah mengikuti pelatihan ini.\n\n";
        $message .= "_Pesan ini dikirim otomatis oleh sistem SIAP_";
        
        return $this->sendMessage($phoneNumber, $message);
    }
}
