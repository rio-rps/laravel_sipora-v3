<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanAkunModel extends Model
{
    use HasFactory;
    public $table = "users";
    protected $primarykey = "id";
    protected $fillable = ['name', 'email', 'password', 'level'];
}
