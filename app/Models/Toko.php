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
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function bumdes()
    {
        return $this->belongsTo(Bumdes::class, 'id_bumdes', 'id_bumdes');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    public function verifikasi()
    {
        return $this->hasOne(VerifikasiToko::class, 'id_toko', 'id_toko');
    }

    public function produk()
    {
        return $this->hasMany(Product::class, 'id_toko', 'id_toko');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_toko');
    }
}

