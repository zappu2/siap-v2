<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'unit_kerja',
        'jabatan',
        'avatar',
        'nama_lengkap',
        'agama',
        'pangkat_golongan',
        'tmt_jabatan',
        'tmt_cpns',
        'tmt_pangkat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'alamat_rumah_1',
        'alamat_rumah_2',
        'provinsi',
        'kab_kota',
        'kode_pos',
        'nomor_handphone',
        'alamat_kantor',
        'telepon_kantor',
        'nama_bank',
        'no_rekening',
        'nama_di_bank',
        'npwp',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tmt_jabatan' => 'date',
            'tmt_cpns' => 'date',
            'tmt_pangkat' => 'date',
            'tanggal_lahir' => 'date',
            'roles' => 'array',
        ];
    }
}
