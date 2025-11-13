<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SertifikatPelatihanJarakJauh extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_pelatihan_jarak_jauh';

    protected $fillable = [
        'peserta_pelatihan_jarak_jauh_id',
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
        return $this->belongsTo(PesertaPelatihanJarakJauh::class, 'peserta_pelatihan_jarak_jauh_id');
    }
}
