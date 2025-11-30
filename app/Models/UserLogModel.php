<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogModel extends Model
{
    use HasFactory;
    public $table = "users_log";
    protected $primarykey = "id_log";
    protected $fillable = [
        'id_user',
        'aktivitas',
    ];
}
