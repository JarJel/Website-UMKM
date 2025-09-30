<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
    protected $table = 'item_pesanan';
    protected $primaryKey = 'id_item_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_pesanan', 'id_varian_produk', 'nama_produk_snapshot',
        'id_produk',
        'harga_saat_pesan', 'jumlah', 'berat_per_item_kg'
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
