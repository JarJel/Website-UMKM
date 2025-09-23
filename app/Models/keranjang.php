<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    public $timestamps = false;
    protected $fillable = ['id_pengguna'];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function items()
    {
        return $this->hasMany(ItemKeranjang::class, 'id_keranjang', 'id_keranjang')
            ->with('produk');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }


    protected static function booted()
    {
        static::deleting(function ($keranjang) {
            $keranjang->items()->delete();
        });
    }
}
