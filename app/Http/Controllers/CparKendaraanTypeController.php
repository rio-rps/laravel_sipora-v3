<?php

namespace App\Http\Controllers;

use App\Models\CparKendaraanMerekModel;
use App\Models\CparKendaraanTypeModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class CparKendaraanTypeController extends Controller
{


    public function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = CparKendaraanTypeModel::whereRaw("slug_type_kendaraan  RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return ($count > 0) ? "{$slug}-{$count}" : $slug;
    }


    public function index()
    {
        $data = [
            'title' => 'DATA TYPE KENDARAAN',
        ];
        return view('private/kendaraan_type/view')->with($data);
    }

    public function create()
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
                'resultMerek' => CparKendaraanMerekModel::all(),
            ];
            return view('private.kendaraan_type.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function store(Request $r)
    {
        if (request()->ajax()) {
            $merek = $r->id_merek_kendaraan;
            $validator = Validator::make($r->all(), [
                'id_merek_kendaraan' => 'required',
                'nm_type_kendaraan' => [
                    'required',
                    function ($attribute, $value, $fail) use ($merek) {
                        $isUnique = CparKendaraanTypeModel::where('nm_type_kendaraan', $value)
                            ->where('id_merek_kendaraan', $merek)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Type Kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'id_merek_kendaraan.required' => 'Nama Merek Kendaraan Tidak Boleh Kosong',
                'nm_type_kendaraan.required' => 'Nama Type Kendaraan Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparKendaraanTypeModel::create([
                    'id_merek_kendaraan'  => $r->id_merek_kendaraan,
                    'nm_type_kendaraan'  => $r->nm_type_kendaraan,
                    'slug_type_kendaraan' => $this->createSlug($r->slug_type_kendaraan),
                    'status_actived'  => '1',
                ]);
                return response()->json(['success' => 'Data berhasil disimpan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function show()
    {
        if (request()->ajax()) {
            return  DataTables::of(CparKendaraanTypeModel::query())
                ->addColumn('action', 'private.kendaraan_type.action')

                ->addColumn('kendaraanMerek', function ($row) {
                    return $row->kendaraanMerek->nm_merek_kendaraan;
                })
                ->filterColumn('kendaraanMerek', function ($query, $keyword) {
                    $query->whereHas('kendaraanMerek', function ($query) use ($keyword) {
                        $query->where('nm_merek_kendaraan', 'like', "%{$keyword}%");
                    });
                })

                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit($id)
    {

        if (request()->ajax()) {
            $row = CparKendaraanTypeModel::where('id_type_kendaraan', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.kendaraan_type.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function update(Request $r, $id)
    {
        if (request()->ajax()) {
            $merek = $r->id_merek_kendaraan;
            $validator = Validator::make($r->all(), [
                'nm_type_kendaraan' =>  [
                    'required',
                    function ($attribute, $value, $fail) use ($id, $merek) {
                        $isUnique = CparKendaraanTypeModel::where('nm_type_kendaraan', $value)
                            ->where('id_type_kendaraan', '!=', $id)
                            ->where('id_merek_kendaraan', $merek)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Type Kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'nm_type_kendaraan.required' => 'Nama Type Kendaran Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparKendaraanTypeModel::where('id_type_kendaraan', $id)->update([
                    'nm_type_kendaraan'  => $r->nm_type_kendaraan,
                    'slug_type_kendaraan'  => $this->createSlug($r->nm_type_kendaraan),
                ]);
                return response()->json(['success' => 'Data berhasil diedit']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $cek = PengajuanPermohonanModel::where('id_type_kendaraan', $id)->count();
            if ($cek > 0) {
                return response()->json(['error' => 'Tidak Dapat di Hapus, Data Sudah dipakai / Hubungi Admin']);
            } else {
                CparKendaraanTypeModel::where('id_type_kendaraan', $id)->delete();
                return response()->json([
                    'success' => 'Data berhasil dihapus',
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
