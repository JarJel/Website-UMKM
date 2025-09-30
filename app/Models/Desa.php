<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string'; // Tipe data bigint(20)
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }
}