<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $incrementing = true;

    protected $fillable = [
        'nama_pengguna',
        'email',
        'kata_sandi',
        'nama_lengkap',
        'nomor_telepon',
        'id_role',
        'verification_code',
        'email_verified_at',
        'photo'
    ];

    protected $hidden = ['kata_sandi', 'verification_code'];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    public function toko()
    {
        return $this->hasOne(Toko::class, 'id_pengguna', 'id_pengguna');
    }

    public function cartItems()
    {
        return $this->hasMany(ItemKeranjang::class, 'id_keranjang', 'id_pengguna');
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'id_pengguna', 'id_pengguna');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pengguna', 'id_pengguna');
    }

    public function keranjang()
    {
        return $this->hasOne(Keranjang::class, 'id_pengguna');
    }


    public function roles()
    {
        return $this->hasMany(PenggunaRole::class, 'id_pengguna', 'id_pengguna');
    }
}
