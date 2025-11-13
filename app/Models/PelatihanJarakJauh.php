<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PelatihanJarakJauh extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_pelatihan',
        'penyelenggara',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'terlihat',
        // New fields from edit form
        'nama',
        'display_name',
        'short_name',
        'course_category',
        'kategori_order',
        'id_number',
        'summary',
        'summary_format',
        'news_items',
        'tanggal_akhir',
        'group_mode',
        'visible',
    ];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_akhir' => 'date',
        'terlihat' => 'boolean',
        'visible' => 'boolean',
        'kategori_order' => 'integer',
        'summary_format' => 'integer',
        'news_items' => 'integer',
        'group_mode' => 'integer',
    ];
    
    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category', 'slug');
    }
}
