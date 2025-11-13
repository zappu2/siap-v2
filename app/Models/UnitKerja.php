<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';
    protected $fillable = ['nama', 'kode_unit'];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }

    public function pelatihanKlasikal()
    {
        return $this->hasMany(PelatihanKlasikal::class, 'penyelenggara_id');
    }
}
