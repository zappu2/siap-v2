<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WhatsAppService;

class TestWhatsAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:test {phone} {--message=Test dari SIAP}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test WhatsApp integration by sending a test message';

    /**
     * Execute the console command.
     */
    public function handle(WhatsAppService $whatsappService)
    {
        $phone = $this->argument('phone');
        $message = $this->option('message');
        
        $this->info("Sending WhatsApp message to: {$phone}");
        $this->info("Message: {$message}");
        $this->newLine();
        
        // Check configuration
        $enabled = config('services.whatsapp.enabled');
        $token = config('services.whatsapp.token');
        
        if (!$enabled) {
            $this->error('WhatsApp service is DISABLED in config!');
            $this->info('Set WHATSAPP_ENABLED=true in your .env file');
            return Command::FAILURE;
        }
        
        if (!$token) {
            $this->error('WhatsApp token is NOT configured!');
            $this->info('Set WHATSAPP_TOKEN in your .env file');
            return Command::FAILURE;
        }
        
        $this->info('Configuration OK ✓');
        $this->newLine();
        
        // Send message
        $result = $whatsappService->sendMessage($phone, $message);
        
        if ($result['success']) {
            $this->info('✓ Message sent successfully!');
            $this->newLine();
            $this->line('Response:');
            $this->line(json_encode($result['data'], JSON_PRETTY_PRINT));
            return Command::SUCCESS;
        } else {
            $this->error('✗ Failed to send message!');
            $this->error($result['message'] ?? 'Unknown error');
            $this->newLine();
            $this->info('Check logs: storage/logs/laravel.log');
            return Command::FAILURE;
        }
    }
}
