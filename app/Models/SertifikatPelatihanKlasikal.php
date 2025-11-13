<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SertifikatPelatihanKlasikal extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_pelatihan_klasikal';

    protected $fillable = [
        'peserta_pelatihan_klasikal_id',
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
        return $this->belongsTo(PesertaPelatihanKlasikal::class, 'peserta_pelatihan_klasikal_id');
    }
}
