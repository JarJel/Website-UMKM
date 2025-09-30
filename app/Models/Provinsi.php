<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $primaryKey = 'id'; // Sesuai kolom 'id'
    public $incrementing = false; // kalau id bukan auto increment
    protected $keyType = 'string'; // jika id bertipe string
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi', 'id');
    }
}

