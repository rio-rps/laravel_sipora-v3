<?php

namespace App\Http\Controllers;

use App\Models\CparJenisAngkutanModel;
use App\Models\CparMengangkutModel;
use App\Models\MappingMengangkutModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CparMengangkutController extends Controller
{

    public function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = CparMengangkutModel::whereRaw("slug_mengangkut  RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return ($count > 0) ? "{$slug}-{$count}" : $slug;
    }

    public function index()
    {
        $data = [
            'title' => 'DATA MENGANGKUT',
        ];
        return view('private/mengangkut/view')->with($data);
    }


    public function create()
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
            ];
            return view('private.mengangkut.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function store(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'nm_mengangkut' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = CparMengangkutModel::where('nm_mengangkut', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Mengangkut sudah ada');
                        }
                    }
                ],
            ], [
                'nm_mengangkut.required' => 'Nama Mengangkut Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparMengangkutModel::create([
                    'nm_mengangkut'  => $r->nm_mengangkut,
                    'slug_mengangkut' => $this->createSlug($r->nm_mengangkut),
                    'status_actived'  => '1',
                ]);
                return response()->json(['success' => 'Data berhasil disimpan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function storeMapping(Request $r)
    {
        if (request()->ajax()) {

            $cek = MappingMengangkutModel::where('id_mengangkut', $r->id_mengangkut)
                ->where('id_jenis_angkutan', $r->id_jenis_angkutan)->get();
            $jmx = count($cek);
            if ($jmx > 0) {
                return response()->json(['error' => 'Data sudah ada']);
            } else {
                $post = MappingMengangkutModel::create([
                    'id_mengangkut' => $r->id_mengangkut,
                    'id_jenis_angkutan' => $r->id_jenis_angkutan,
                ]);
                return response()->json(['success' => 'Data berhasil pilih', 'action' => 'storeMappingMengangkut']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function show()
    {
        if (request()->ajax()) {
            return  DataTables::of(CparMengangkutModel::query())
                ->addColumn('action', 'private.mengangkut.action')
                ->addColumn('jumlahMapping', function ($row) {
                    $count = MappingMengangkutModel::where('id_mengangkut', $row->id_mengangkut)->count();
                    return '<span class="badge badge-secondary">' . $count . ' Data</span>';
                })
                ->rawColumns(['action', 'jumlahMapping'])
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function showJenisAngkutanData(request $r)
    {
        if (request()->ajax()) {
            return  DataTables::of(MappingMengangkutModel::where('id_mengangkut', $r->id_mengangkut)->get())
                ->addColumn('action', function ($row) {

                    $btn = '<form method="POST" action="' . route('cparMengangkut.destroyMapping', $row->id_mapping_mengangkut) . '" class="formDelete" style="display: inline"> 
                            <input type="hidden" name="_method" value="DELETE">        
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data" >
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>';

                    return $btn;
                })
                ->addColumn('jenisAngkut', function ($row) {
                    return $row->JCparJenisAngkutan->nm_jenis_angkutan;
                })
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function showJenisAngkutan(request $r)
    {
        if (request()->ajax()) {
            $id_mengangkut = $r->id_mengangkut;
            return  DataTables::of(CparJenisAngkutanModel::all())
                ->addColumn('action', function ($row) use ($id_mengangkut) {

                    $btn = '<form method="POST" action="' . route('cparMengangkut.storeMapping') . '" class="formPilih" style="display: inline"> 
                            <input type="hidden" name="id_mengangkut" value="' . $id_mengangkut . '">
                            <input type="hidden" name="id_jenis_angkutan" value="' . $row->id_jenis_angkutan . '">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button type="submit" class="btn btn-sm btn-success" title="Pilih Data" >
                                <i class="fa fa-check"></i>
                            </button>
                        </form>';

                    return $btn;
                })
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit($id)
    {
        if (request()->ajax()) {
            $row = CparMengangkutModel::where('id_mengangkut', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.mengangkut.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function update(Request $r, $id)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'nm_mengangkut' =>  [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = CparMengangkutModel::where('nm_mengangkut', $value)
                            ->where('id_mengangkut', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nama Mengangkut sudah ada');
                        }
                    }
                ],
            ], [
                'nm_mengangkut.required' => 'Nama Mengangkut Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = CparMengangkutModel::where('id_mengangkut', $id)->update([
                    'nm_mengangkut'  => $r->nm_mengangkut,
                    'slug_mengangkut'  => $this->createSlug($r->nm_mengangkut),
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
            $cek = MappingMengangkutModel::where('id_mengangkut', $id)->get();
            if (count($cek) > 0) {
                return response()->json(['error' => 'Tidak Dapat di Hapus, Ada data Mapping terhubung / Hubungi Admin']);
            }

            $cek = PengajuanPermohonanModel::where('id_mengangkut', $id)->count();
            if ($cek > 0) {
                return response()->json(['errors' => 'Tidak bisa dihapus sudah duganakan, hubungi admin'], 423);
            }

            CparMengangkutModel::where('id_mengangkut', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil dihapus',
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroyMapping($id)
    {
        if (request()->ajax()) {
            MappingMengangkutModel::where('id_mapping_mengangkut', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil dihapus',
                'action' => 'destroyMappingMengangkut',
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function createMapping($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'MAPPING DATA JENIS ANGKUTAN',
                'id_mengangkut' => $id
            ];
            return view('private.mengangkut.formaddmappingview', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
    public function createMappingForm($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'PILIH JENIS ANGKUTAN',
                'id_mengangkut' => $id
            ];
            return view('private.mengangkut.formaddmappingform', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
