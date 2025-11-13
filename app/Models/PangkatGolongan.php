<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PangkatGolongan extends Model
{
    use HasFactory;

    protected $table = 'pangkat_golongans';
    protected $fillable = ['nama', 'kode_golongan'];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }
}
