<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenggunaRole extends Model
{
    protected $table = 'pengguna_role';
    protected $fillable = ['id_pengguna', 'id_role'];

    public $timestamps = false; // jika tidak ada kolom created_at / updated_at
}
