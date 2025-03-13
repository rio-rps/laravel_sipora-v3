<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparMengangkutModel extends Model
{
    use HasFactory;
    public $table = "cpar_mengangkut_001_mengangkut";
    protected $primarykey = "id_mengangkut";
    protected $fillable = [
        'nm_mengangkut', 'slug_mengangkut', 'status_actived'
    ];

    public function JMapppingMengangkut()
    {
        return $this->belongsTo(MappingMengangkutModel::class, 'id_mengangkut', 'id_mengangkut');
    }
}
