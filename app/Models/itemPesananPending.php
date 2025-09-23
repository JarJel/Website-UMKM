<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ItemPesananPending extends Model
{
    protected $table = 'item_pesanan_pending';
    protected $primaryKey = 'id_item_pesanan_pending'; // sesuaikan kalau berbeda
    public $timestamps = false;
    protected $fillable = ['id_pending','id_produk','nama_produk_snapshot','harga_saat_pilih','jumlah','berat_per_item_kg'];

    public function pesanan()
    {
        return $this->belongsTo(PesananPending::class, 'id_pending', 'id_pending');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}
