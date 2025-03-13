<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UploadModel extends Model
{
    use HasFactory;
    public $table = "ddd_biodata_upload_dok";
    protected $primarykey = "id_upload_dok";
    protected $fillable = [
        'jenis_dok', 'file_dokumen', 'id_biodata'
    ];
}
