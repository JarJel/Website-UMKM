<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    
    protected $fillable = [
        'id_toko',
        'gambar_produk',
        'nama_produk',
        'deskripsi_produk',
        'harga_dasar',
        'stok',
        'rating_produk',
        'id_kategori',
        'tanggal_ditambahkan',
    ];

    public function getRouteKeyName()
    {
        return 'id_produk';
    }
}
