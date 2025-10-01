<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    protected $table = 'pengguna'; // jika tabel sama dengan pengguna
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama', 'email', 'password']; // sesuaikan
}
