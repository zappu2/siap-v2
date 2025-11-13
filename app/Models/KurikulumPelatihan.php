<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KurikulumPelatihan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_pelatihan',
        'jenis_pelatihan',
        'jam_pelajaran',
        'kompetensi',
        'catatan',
        'sertifikat_depan',
        'sertifikat_belakang',
    ];
    
    protected $casts = [
        'jam_pelajaran' => 'integer',
    ];
    
    public function detailCurricula()
    {
        return $this->hasMany(DetailCurriculum::class);
    }
}
