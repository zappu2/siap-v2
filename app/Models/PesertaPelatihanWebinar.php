<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaPelatihanWebinar extends Model
{
    use HasFactory;

    protected $table = 'peserta_pelatihan_webinar';

    protected $fillable = [
        'pengguna_id',
        'pelatihan_webinar_id',
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

    public function pelatihanWebinar()
    {
        return $this->belongsTo(PelatihanWebinar::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(SertifikatPelatihanWebinar::class);
    }
}
