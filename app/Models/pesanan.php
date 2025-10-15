<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna', 
        'id_toko', 
        'id_alamat',
        'total_harga_produk', 
        'biaya_pengiriman',
        'metode_pembayaran', 
        'status_pesanan', 
        'is_diterima',
        'tanggal_pesanan',
    ];

    // Casting agar status_pesanan terbaca sebagai string
    protected $casts = [
        'status_pesanan' => 'string',
    ];

    public function ulasan()
    {
        return $this->hasMany(\App\Models\Ulasan::class, 'id_pengguna', 'id_pengguna');
    }



    // Relasi ke User (pembeli)
    public function pembeli()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    // Relasi ke ItemPesanan
    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi ke Alamat
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }

    // Relasi ke Toko
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }

    public function itemPesanan()
    {
        return $this->hasMany(\App\Models\ItemPesanan::class, 'id_pesanan');
    }

    /**
     * Accessor: ambil status dengan format kapital di awal
     */
    public function getStatusPesananLabelAttribute()
    {
        return ucfirst($this->status_pesanan);
    }

    /**
     * Mutator: update status pesanan dengan validasi sederhana
     */
    public function setStatusPesananAttribute($value)
    {
        $allowed = ['diproses', 'diantarkan', 'selesai', 'pending', 'dibatalkan'];

        if (in_array($value, $allowed)) {
            $this->attributes['status_pesanan'] = $value;
        } else {
            throw new \InvalidArgumentException("Status pesanan tidak valid: {$value}");
        }
    }
}
