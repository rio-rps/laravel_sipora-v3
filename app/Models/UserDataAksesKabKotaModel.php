<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDataAksesKabKotaModel extends Model
{
    use HasFactory;
    public $table = "users_akses_kabkota";
    protected $primarykey = "id_user_akses_kabkota";
    protected $fillable = [
        'id_user',
        'kode_provinsi',
        'kode_kabkota',
    ];
}
