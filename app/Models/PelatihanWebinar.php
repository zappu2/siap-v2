<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelatihanWebinar extends Model
{
    protected $fillable = [
        'nama',
        'sertifikat_url',
        'sertifikat_filename',
        'sertifikat_size',
    ];
}
