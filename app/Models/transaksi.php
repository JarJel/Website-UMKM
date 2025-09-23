<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Nama tabel (kalau default plural "transaksis" tidak sesuai)
    protected $table = 'transaksi';

    // Primary key
    protected $primaryKey = 'id_transaksi';

    // Kalau primary key bukan auto-increment integer, tambahkan:
    // public $incrementing = true;
    // protected $keyType = 'int';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'id_pesanan',
        'gateway_pembayaran',
        'status_transaksi',
        'snap_token',
        'virtual_account',
        'ewallet_id',
        'gross_amount',
        'raw_response',
        'paid_at',
        'tanggal_transaksi',
    ];

    // Timestamps default (created_at, updated_at) → nonaktif kalau tidak ada di tabel
    public $timestamps = false;

    // Casting otomatis (opsional)
    protected $casts = [
        'gross_amount' => 'integer',
        'paid_at' => 'datetime',
        'tanggal_transaksi' => 'datetime',
    ];

    // Relasi ke PesananPending (jika ada modelnya)
    public function pesanan()
    {
        return $this->belongsTo(PesananPending::class, 'id_pesanan', 'id_pending');
    }
}
