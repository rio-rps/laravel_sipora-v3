<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesUrlModel extends Model
{
    use HasFactory;
    public $table = "aaa_access";
    protected $primarykey = "id";
    protected $fillable = [
        'url', 'access', 'status_actived'
    ];
}
