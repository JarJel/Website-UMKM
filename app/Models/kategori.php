<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori', 'id_bumdes', 'slug_kategori','icon']; // tambahkan id_bumdes

    public function produk()
    {
        return $this->hasMany(Product::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke BUMDES (opsional, kalau ingin akses data BUMDES dari kategori)
    public function bumdes()
    {
        return $this->belongsTo(Bumdes::class, 'id_bumdes', 'id_bumdes');
    }
}
