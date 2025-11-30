<?php

namespace App\Http\Controllers;

use App\Models\CparPermohonanModel;
use App\Models\CparTrayekModel;
use App\Models\MyModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class CparTrayekController extends Controller
{




    public function createSlug($title, $id_trayek = null)
    {
        $slug = Str::slug($title);

        // Cek apakah post yang diedit memiliki slug yang sama dengan post lain di database
        $query = CparTrayekModel::where('slug_trayek', $slug);
        if ($id_trayek) {
            $query->where('id_trayek', '<>', $id_trayek);
        }
        $count = $query->count();

        return ($count > 0) ? "{$slug}-{$count}" : $slug;
    }



    public function index()
    {
        $data = [
            'title' => 'DATA TRAYEK',
        ];
        return view('private/trayek/view')->with($data);
    }


    public function create()
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
                'result' => CparPermohonanModel::whereIn('id_par_permohonan', ['3', '4', '5', '8'])->get()
            ];
            return view('private.trayek.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function store(Request $r)
    {
        if (request()->ajax()) {
            $id_par_permohonan = $r->id_par_permohonan;
            $validator = Validator::make($r->all(), [
                'id_par_permohonan' => 'required',
                'nm_trayek' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id_par_permohonan) {
                        $isUnique = CparTrayekModel::where('nm_trayek', $value)
                            ->where('id_par_permohonan', $id_par_permohonan)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Trayek sudah ada');
                        }
                    }
                ],
            ], [
                'id_par_permohonan.required' => 'Jenis Trayek Permohonan Tidak Boleh Kosong',
                'nm_trayek.required' => 'Nama Trayek Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $slug_trayek = $this->createSlug($r->nm_trayek);
                $post = CparTrayekModel::create([
                    'id_par_permohonan'  => $r->id_par_permohonan,
                    'nm_trayek'  => $r->nm_trayek,
                    'slug_trayek' => $slug_trayek,
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
            return  DataTables::of(CparTrayekModel::query())
                ->addColumn('action', 'private.trayek.action')

                ->addColumn('JCparPermohonan', function ($row) {
                    return $row->JCparPermohonan->nm_par_permohonan;
                })
                ->filterColumn('JCparPermohonan', function ($query, $keyword) {
                    $query->whereHas('JCparPermohonan', function ($query) use ($keyword) {
                        $query->where('nm_par_permohonan', 'like', "%{$keyword}%");
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
            $row = CparTrayekModel::where('id_trayek', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.trayek.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }


    public function update(Request $r, $id)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'nm_trayek' =>  [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = CparTrayekModel::where('nm_trayek', $value)
                            ->where('id_trayek', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Trayek sudah ada');
                        }
                    }
                ],
            ], [
                'nm_trayek.required' => 'Nama Trayek Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $slug_trayek = $this->createSlug($r->nm_trayek, $id);

                $post = CparTrayekModel::where('id_trayek', $id)->update([
                    'nm_trayek'  => $r->nm_trayek,
                    'slug_trayek'  => $slug_trayek,
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
            $cek = PengajuanPermohonanModel::where('id_trayek', $id)->count();
            if ($cek > 0) {
                return response()->json(['errors' => 'Tidak bisa dihapus sudah duganakan, hubungi admin'], 423);
            }
            CparTrayekModel::where('id_trayek', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil dihapus',
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
