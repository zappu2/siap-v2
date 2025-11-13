<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPelatihan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'visible',
        'id_number',
        'kode_satker',
        'kota',
        'description_format',
        'parent',
        'sort_order',
        'course_count',
        'path',
        'theme',
    ];
    
    protected $casts = [
        'visible' => 'boolean',
        'parent' => 'integer',
        'sort_order' => 'integer',
        'course_count' => 'integer',
    ];
}
