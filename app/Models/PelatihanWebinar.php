<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelatihanWebinar extends Model
{
    protected $fillable = [
        'nama',
        'sertifikat_url',
        'sertifikat_filename',
        'sertifikat_size',
    ];
    
    /**
     * Get formatted file size
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->sertifikat_size) {
            return 'N/A';
        }
        
        $bytes = (int) $this->sertifikat_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
