<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string'; // Tipe data char(7)
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }
}