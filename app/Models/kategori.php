<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false; // kalau tidak pakai created_at/updated_at
    protected $fillable = ['nama_kategori'];
}
