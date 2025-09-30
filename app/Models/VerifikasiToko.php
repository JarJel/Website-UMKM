<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifikasiToko extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_toko';
    protected $primaryKey = 'id_verifikasi_toko';
    protected $guarded = [];

    // Cast tanggal_verifikasi agar menjadi Carbon instance
    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
    ];

    // Relasi ke Toko
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko', 'id_toko');
    }
}
