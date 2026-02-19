<?php

namespace App\Http\Controllers;

use App\Models\CparJenisPermohonanModel;
use App\Models\CparPermohonanModel;
use App\Models\MyModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Str;

class CparJenisPermohonanController extends Controller
{
    public function index()
    {
        if (isAdmin()) {
            $data = [
                'result' => CparJenisPermohonanModel::all(),
                //'resultPermohonan' => Permohonan::with('tableB')->get(),
                'title' => 'DATA JENIS PERMOHONAN',
            ];
            return view('private/jenis_permohonan/view')->with($data);
        }
        abort(404);
    }

    public function show()
    {
        if (request()->ajax()) {

            return  DataTables::of(CparJenisPermohonanModel::all())
                ->addColumn('action', function ($row) {
                    return 'aaaaaa';
                })
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function tab1Data()
    {
        return DataTables::of(CparJenisPermohonanModel::query())
            ->addColumn('action', function ($data) {
                //$next = route('cparJenisPermohonan.data-tab2', $data->id_jenis_permohonan);
                $link = "<button class='btn btn-sm btn-primary btn-next-tab2' data-target='#tab2' data-id='{$data->id_jenis_permohonan}'><i class='fa fa-fast-forward'></button>";
                return $link;
            })
            ->make(true);
    }

    public function tab2Data(Request $r)
    {
        $data = CparPermohonanModel::where('id_jenis_permohonan', $r->id)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "aaaa";
            })
            ->make(true);
    }
}
