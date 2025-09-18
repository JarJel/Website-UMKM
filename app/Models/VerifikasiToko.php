<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiToko extends Model
{
    protected $table = 'verifikasi_toko';
    protected $primaryKey = 'id_verifikasi_toko';
    protected $guarded = [];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'id_toko', 'id_toko');
    }
}
