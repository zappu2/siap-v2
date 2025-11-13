<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans';
    protected $fillable = ['nama'];

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class);
    }
}
