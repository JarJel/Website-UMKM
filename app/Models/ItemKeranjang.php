<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKeranjang extends Model
{
    protected $table = 'item_keranjang';
    protected $primaryKey = 'id_item_keranjang';
    public $timestamps = false;

    protected $fillable = ['id_keranjang', 'id_produk', 'id_varian_produk', 'jumlah_produk'];

    // Relasi ke keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang', 'id_keranjang');
    }

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}
