<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BparBadanUsahaModel extends Model
{
    use HasFactory;
    public $table = "bpar_badan_usaha";
    protected $primarykey = "id_badan_usaha";
    protected $fillable = [
        'nm_badan_usaha', 'status_actived', 'no_urut'
    ];
}
