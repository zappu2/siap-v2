<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'name', // For Filament compatibility
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'status_kawin',
        'alamat',
        'provinsi_id',
        'kab_kota_id',
        'no_telepon',
        'email',
        'email_verified_at',
        'password',
        'pangkat_golongan_id',
        'pendidikan_id',
        'unit_kerja_id',
        'jabatan',
        'foto_profil',
        'no_rekening',
        'nama_rekening',
        'nama_bank',
        'role_id',
        'tanda_tangan',
        'is_active',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function pangkatGolongan()
    {
        return $this->belongsTo(PangkatGolongan::class);
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabKota()
    {
        return $this->belongsTo(KabKota::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Accessor for Filament compatibility
    public function getNameAttribute()
    {
        return $this->nama_lengkap;
    }

    // Training relationships
    public function pesertaPelatihanJarakJauh()
    {
        return $this->hasMany(PesertaPelatihanJarakJauh::class);
    }

    public function pesertaPelatihanKlasikal()
    {
        return $this->hasMany(PesertaPelatihanKlasikal::class);
    }

    public function pesertaPelatihanWebinar()
    {
        return $this->hasMany(PesertaPelatihanWebinar::class);
    }

    // Certificate relationships
    public function sertifikatPelatihanJarakJauh()
    {
        return $this->hasMany(SertifikatPelatihanJarakJauh::class);
    }

    public function sertifikatPelatihanKlasikal()
    {
        return $this->hasMany(SertifikatPelatihanKlasikal::class);
    }

    public function sertifikatPelatihanWebinar()
    {
        return $this->hasMany(SertifikatPelatihanWebinar::class);
    }
}
