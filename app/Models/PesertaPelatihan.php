<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaPelatihan extends Model
{
    protected $fillable = [
        'pelatihan_klasikal_id',
        'foto',
        'nama',
        'nip',
        'no_hp',
        'diklat_yang_diikuti',
        'sertifikat_filename',
        'sertifikat_size',
        'sertifikat_tte_filename',
        'nilai_kualifikasi',
    ];

    public function pelatihanKlasikal(): BelongsTo
    {
        return $this->belongsTo(PelatihanKlasikal::class);
    }
}
