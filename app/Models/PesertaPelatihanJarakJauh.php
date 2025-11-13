<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaPelatihanJarakJauh extends Model
{
    use HasFactory;

    protected $table = 'peserta_pelatihan_jarak_jauh';

    protected $fillable = [
        'pengguna_id',
        'pelatihan_jarak_jauh_id',
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

    public function pelatihanJarakJauh()
    {
        return $this->belongsTo(PelatihanJarakJauh::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(SertifikatPelatihanJarakJauh::class);
    }
}
