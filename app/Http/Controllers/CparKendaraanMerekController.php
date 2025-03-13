<?php

namespace App\Http\Controllers;

use App\Models\CparKendaraanMerekModel;
use App\Models\CparKendaraanTypeModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CparKendaraanMerekController extends Controller
{


    public function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = CparKendaraanMerekModel::whereRaw("slug_merek_kendaraan  RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return ($count > 0) ? "{$slug}-{$count}" : $slug;
    }

    public function index()
    {
        $data = [
            'title' => 'DATA MEREK KENDARAAN',
        ];
        return view('private/kendaraan_merek/view')->with($data);
    }

    public function create()
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
            ];
            return view('private.kendaraan_merek.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function store(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'nm_merek_kendaraan' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = CparKendaraanMerekModel::where('nm_merek_kendaraan', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama merek Kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'nm_merek_kendaraan.required' => 'Nama Merek Kendaraan Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparKendaraanMerekModel::create([
                    'nm_merek_kendaraan'  => $r->nm_merek_kendaraan,
                    'slug_merek_kendaraan' => $this->createSlug($r->nm_merek_kendaraan),
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
            return  DataTables::of(CparKendaraanMerekModel::query())
                ->addColumn('action', 'private.kendaraan_merek.action')
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $row = CparKendaraanMerekModel::where('id_merek_kendaraan', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.kendaraan_merek.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }


    public function update(Request $r, $id)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'nm_merek_kendaraan' =>  [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = CparKendaraanMerekModel::where('nm_merek_kendaraan', $value)
                            ->where('id_merek_kendaraan', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama merek Kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'nm_merek_kendaraan.required' => 'Nama Merek Kendaran Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparKendaraanMerekModel::where('id_merek_kendaraan', $id)->update([
                    'nm_merek_kendaraan'  => $r->nm_merek_kendaraan,
                    'slug_merek_kendaraan'  => $this->createSlug($r->nm_merek_kendaraan),
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
            $cek = CparKendaraanTypeModel::where('id_merek_kendaraan', $id)->get();
            if (count($cek) > 0) {
                return response()->json(['error' => 'Tidak Dapat di Hapus, Data Sudah Ada Type / Hubungi Admin']);
            } else {
                CparKendaraanMerekModel::where('id_merek_kendaraan', $id)->delete();
                return response()->json([
                    'success' => 'Data berhasil dihapus',
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
