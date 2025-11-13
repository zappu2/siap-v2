<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaPelatihanKlasikal extends Model
{
    use HasFactory;

    protected $table = 'peserta_pelatihan_klasikal';

    protected $fillable = [
        'pengguna_id',
        'pelatihan_klasikal_id',
        'tanggal_daftar',
        'status_kelulusan'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function pelatihanKlasikal()
    {
        return $this->belongsTo(PelatihanKlasikal::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(SertifikatPelatihanKlasikal::class);
    }
}
