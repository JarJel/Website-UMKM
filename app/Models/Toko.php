<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $primaryKey = 'id_toko';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function verifikasi()
    {
        return $this->hasOne(VerifikasiToko::class, 'id_toko', 'id_toko');
    }

    public function produk()
    {
        return $this->hasMany(Product::class, 'id_toko', 'id_toko');
    }
}

