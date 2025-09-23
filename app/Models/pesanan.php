<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna', 'id_toko', 'id_alamat',
        'total_harga_produk', 'biaya_pengiriman',
        'metode_pembayaran', 'status_pesanan', 'tanggal_pesanan'
    ];

    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'id_pesanan');
    }

    public function alamat(){
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }
}
