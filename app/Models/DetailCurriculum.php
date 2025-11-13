<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailCurriculum extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kurikulum_pelatihan_id',
        'kelompok_pelatihan',
        'detail_mata_pelatihan',
        'detail_items',
    ];
    
    protected $casts = [
        'detail_items' => 'array',
    ];
    
    public function kurikulumPelatihan()
    {
        return $this->belongsTo(KurikulumPelatihan::class);
    }
}