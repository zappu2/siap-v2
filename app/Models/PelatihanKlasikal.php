<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PelatihanKlasikal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'penyelenggara',
        'tanggal_pelaksanaan_mulai',
        'tanggal_pelaksanaan_selesai',
        'peserta',
        'verifikasi',
        'selesai',
        'bisa_ditandatangani',
        'tahun_pelaksanaan',
        // New fields from create form
        'jenis_pelatihan',
        'kurikulum',
        'tahun',
        'id_diklat',
        'penandatangan_sertifikat',
        'terlihat',
        'jumlah_isi_evaluasi',
    ];
    
    protected $casts = [
        'tanggal_pelaksanaan_mulai' => 'date',
        'tanggal_pelaksanaan_selesai' => 'date',
        'peserta' => 'integer',
        'verifikasi' => 'boolean',
        'selesai' => 'boolean',
        'bisa_ditandatangani' => 'boolean',
        'tahun_pelaksanaan' => 'integer',
        'tahun' => 'integer',
        'terlihat' => 'boolean',
        'jumlah_isi_evaluasi' => 'integer',
    ];

    public function pesertaPelatihan(): HasMany
    {
        return $this->hasMany(PesertaPelatihan::class);
    }
}
