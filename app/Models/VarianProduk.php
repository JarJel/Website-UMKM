<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianProduk extends Model
{
    protected $table = 'varian_produk';
    protected $primaryKey = 'id_varian';
    protected $fillable = ['id_produk', 'nama_varian', 'sku', 'harga_varian', 'stok_varian', 'berat_varian_kg'];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}

