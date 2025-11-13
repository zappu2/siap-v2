<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SertifikatPelatihanWebinar extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_pelatihan_webinar';

    protected $fillable = [
        'peserta_pelatihan_webinar_id',
        'nomor_sertifikat',
        'tanggal_terbit',
        'file_sertifikat',
        'file_tte'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
        ];
    }

    public function peserta()
    {
        return $this->belongsTo(PesertaPelatihanWebinar::class, 'peserta_pelatihan_webinar_id');
    }
}
