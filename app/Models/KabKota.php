<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KabKota extends Model
{
    use HasFactory;

    protected $table = 'kab_kota';
    protected $fillable = ['nama', 'kode_kabkota', 'provinsi_id'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }
}
