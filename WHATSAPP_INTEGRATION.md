# WhatsApp Integration for Certificate Notifications

This feature automatically sends WhatsApp notifications to users when their certificates are uploaded or updated.

## Features

✅ Automatic notifications when certificates are uploaded
✅ Sends to all 3 types of training:
  - Pelatihan Webinar
  - Pelatihan Klasikal  
  - Pelatihan Jarak Jauh
✅ Only sends to users with phone numbers
✅ Formatted Indonesian phone numbers (62xxx)
✅ Professional notification messages
✅ Full logging for debugging
✅ Can be enabled/disabled via config

## Setup Instructions

### 1. Get WhatsApp API Token

#### Option A: Fonnte (Recommended for Indonesia)
1. Visit https://fonnte.com
2. Register and verify your account
3. Add a WhatsApp device
4. Get your API token from dashboard
5. Copy the token

#### Option B: Other Providers
- **Wablas**: https://wablas.com
- **Twilio**: https://www.twilio.com/whatsapp
- **Waboxapp**: https://www.waboxapp.com

### 2. Configure Environment Variables

Edit your `.env` file:

```env
WHATSAPP_ENABLED=true
WHATSAPP_API_URL=https://api.fonnte.com/send
WHATSAPP_TOKEN=your-actual-token-here
```

**Important:** Replace `your-actual-token-here` with your real token!

### 3. Test the Integration

You can test by creating a certificate for a user with a phone number:

```bash
php artisan tinker
```

Then run:
```php
$service = app(\App\Services\WhatsAppService::class);
$service->sendMessage('081234567890', 'Test message from SIAP');
```

## How It Works

1. **When a certificate is uploaded** (created or updated), the system automatically:
   - Detects the change via Model Observers
   - Gets the participant's information
   - Checks if the user has a phone number
   - Formats the phone number to international format (62xxx)
   - Sends a WhatsApp notification

2. **Notification Message Format:**
   ```
   Halo *[User Name]*,

   Selamat! 🎉

   Sertifikat pelatihan Anda telah tersedia:

   📋 *Pelatihan:* [Training Name]
   🔖 *Nomor Sertifikat:* [Certificate Number]

   Anda dapat mengunduh sertifikat melalui dashboard SIAP.

   Terima kasih telah mengikuti pelatihan ini.

   _Pesan ini dikirim otomatis oleh sistem SIAP_
   ```

## Phone Number Format

The system automatically formats Indonesian phone numbers:
- `081234567890` → `6281234567890`
- `0812-3456-7890` → `6281234567890`
- `+62 812 3456 7890` → `6281234567890`

## Logging

All WhatsApp notifications are logged in `storage/logs/laravel.log`:

```
[INFO] WhatsApp message sent - phone: 6281234567890
[WARNING] Pengguna has no phone number - pengguna_id: 123
[ERROR] WhatsApp send failed - error: Connection timeout
```

## Disable Notifications

To temporarily disable WhatsApp notifications, set in `.env`:

```env
WHATSAPP_ENABLED=false
```

Or remove/comment out the token:

```env
# WHATSAPP_TOKEN=
```

## Switching Providers

If you want to use a different WhatsApp provider:

1. Update the API URL in `.env`:
   ```env
   WHATSAPP_API_URL=https://your-provider-api-url.com/send
   ```

2. Update the service method in `app/Services/WhatsAppService.php` to match the provider's API format.

## Files Created

- `app/Services/WhatsAppService.php` - Main service for sending WhatsApp messages
- `app/Observers/SertifikatPelatihanWebinarObserver.php` - Observer for webinar certificates
- `app/Observers/SertifikatPelatihanKlasikalObserver.php` - Observer for klasikal certificates
- `app/Observers/SertifikatPelatihanJarakJauhObserver.php` - Observer for jarak jauh certificates
- `config/services.php` - Added WhatsApp configuration

## Troubleshooting

### Messages not sending?

1. **Check if enabled:**
   ```bash
   php artisan tinker
   config('services.whatsapp.enabled')
   ```

2. **Check if token is set:**
   ```bash
   php artisan tinker
   config('services.whatsapp.token')
   ```

3. **Check logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Test manually:**
   ```bash
   php artisan tinker
   app(\App\Services\WhatsAppService::class)->sendMessage('6281234567890', 'Test');
   ```

### User not receiving messages?

1. Check if user has `no_telepon` in `pengguna` table
2. Verify phone number format is valid
3. Check WhatsApp logs for errors
4. Verify the phone number is registered on WhatsApp

## Support

For issues with:
- **Fonnte API**: https://fonnte.com/support
- **This integration**: Check the logs in `storage/logs/laravel.log`
