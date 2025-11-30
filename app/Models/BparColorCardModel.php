<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BparColorCardModel extends Model
{
    use HasFactory;
    public $table = "bpar_color_card";
    protected $primarykey = "id_color_card";
    protected $fillable = ['id_par_permohonan', 'color_card'];
}
