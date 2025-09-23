<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananPending extends Model
{
    use HasFactory;

    protected $table = 'pesanan_pending';
    protected $primaryKey = 'id_pending';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna', 
        'id_toko', 
        'total_harga_produk', 
        'biaya_pengiriman', 
        'status'
    ];

    public function items()
    {
        return $this->hasMany(ItemPesananPending::class, 'id_pending', 'id_pending');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }
}
