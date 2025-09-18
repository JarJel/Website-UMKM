<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    // use HasFactory;

    // protected $table = 'pengguna';
    // protected $primaryKey = 'id_pengguna';

    // protected $fillable = [
    //     'nama_pengguna',
    //     'email',
    //     'kata_sandi',
    //     'nama_lengkap',
    //     'nomor_telepon',
    //     'id_role',       // tambahkan
    //     'sku',           // tambahkan
    //     'ktp',           // tambahkan
    //     'no_rekening', 
    // ];

    // protected $hidden = ['kata_sandi'];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'pengguna_role', 'id_pengguna', 'id_role');
    // }

    // // override agar autentikasi pakai kolom kata_sandi
    // public function getAuthPassword()
    // {
    //     return $this->kata_sandi;
    // }'

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $guarded = [];

    public function toko()
    {
        return $this->hasOne(Toko::class, 'id_pengguna', 'id_pengguna');
    }
}
