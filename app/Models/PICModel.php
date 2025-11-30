<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PICModel extends Model
{
    use HasFactory;
    public $table = "hhh_pic";
    protected $primarykey = "id_pic";
    protected $fillable = [
        'kode_provinsi',
        'kode_kabkota',
        'no_tlp1',
        'no_tlp2'
    ];
}
