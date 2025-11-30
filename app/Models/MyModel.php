<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MyModel extends Model
{
    use HasFactory;

    public function InsertData($tableName, $data)
    {
        $result = DB::table($tableName)->insert($data);
        return $result;
    }

    public function UpdateData($tableName, $data)
    {
        $result = DB::table($tableName)->update($data);
        return $result;
    }

    public function MyTableKabkota($kode_provinsi, $kode_kabkota)
    {
        $data = DB::table('bpar_002_kabkota')
            ->where('kode_provinsi', $kode_provinsi)
            ->where('kode_kabkota', $kode_kabkota);
        return $data;
    }

    public function countPermohonanByStatus($status_permohonan, $id_biodata)
    {
        $data = DB::table('tr_permohonan')
            ->where('status_permohonan', $status_permohonan)
            ->where('id_biodata', $id_biodata)
            ->count();
        return $data;
    }
}
