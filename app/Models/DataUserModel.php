<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUserModel extends Model
{
    use HasFactory;
    public $table = "users";
    protected $primarykey = "id";
    protected $fillable = ['name', 'email', 'password', 'level'];

    public function JBiodata()
    {
        return $this->belongsTo(BiodataModel::class, 'id_user', 'id');
    }
}
