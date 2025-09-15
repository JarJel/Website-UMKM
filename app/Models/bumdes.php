<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bumdes extends Model
{
    use HasFactory;

    protected $table = 'bumdes';
    protected $primaryKey = 'id_bumdes';

    protected $fillable = [
        'id_desa',
        'id_pengguna',
        'nama_bumdes',
        'kata_sandi',
        'deskripsi',
        'alamat_bumdes',
        'nomor_telepon',
        'email',
        'logo',
        'nomor_rekening',
        'rating_bumdes',
        'jumlah_rating_bumdes',
        'tanggal_dibuat',
    ];

    // Relasi ke Pengguna (misalnya admin BUMDes)
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    // // Relasi ke Desa (opsional kalau tabel desa ada)
    // public function desa()
    // {
    //     return $this->belongsTo(Desa::class, 'id_desa', 'id_desa');
    // }

    
}
