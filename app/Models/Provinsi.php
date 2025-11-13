<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $fillable = ['nama', 'kode_provinsi'];

    public function kabKota()
    {
        return $this->hasMany(KabKota::class);
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }
}
