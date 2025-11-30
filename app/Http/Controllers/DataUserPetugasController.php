<?php

namespace App\Http\Controllers;

use App\Models\AksesKabKotaModel;
use App\Models\DataUserModel;
use App\Models\MyModel;
use App\Models\UserDataAksesKabKotaModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class DataUserPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'DATA USER PETUGAS KIR',
        ];
        return view('private/data_user_petugas/view')->with($data);
    }

    public function create()
    {
        if (request()->ajax()) {
            $dt = DataUserModel::all();
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
            ];
            return view('private.data_user_petugas.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $r)
    {
        if (request()->ajax()) {

            $validator = Validator::make($r->all(), [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataUserModel::where('email', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('email sudah digunakan');
                        }
                    }
                ],
            ], [
                'name.required' => 'Nama tidak boleh kosong.',
                'email.required' => 'Email tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = DataUserModel::create([
                    'name' => $r->name,
                    'email'  => $r->email,
                    'password'  => bcrypt('123456'),
                    'level' => 2,
                ]);
                return response()->json(['success' => 'Data berhasil disimpan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->ajax()) {
            return  DataTables::of(DataUserModel::where('level', 2)->get())
                ->addColumn('action', 'private.data_user_petugas.action')
                ->addColumn('level', function ($row) {
                    return level($row->level);
                })
                ->addColumn('kabkota', function ($row) {
                    $Mymodel = new MyModel();
                    $kabkota = UserDataAksesKabKotaModel::where('id_user', $row->id)->get();

                    $kabkotaNames = [];
                    foreach ($kabkota as $resultAll) {
                        $kabkotaNames[] =  $Mymodel->MyTableKabkota($resultAll->kode_provinsi, $resultAll->kode_kabkota)->first()->nm_kabkota;
                    }
                    if ($kabkotaNames) {
                        return implode(', ', $kabkotaNames) . ' (' . count($kabkota) . ')';
                    } else {
                        return '<span class="badge badge-danger">Belum ada Akses</span>';
                    }
                })
                ->addColumn('stts', function ($row) {
                    return stts_user($row->stts_user);
                })
                ->rawColumns(['kabkota', 'action'])
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // EMAIL

    public function editEmail($id)
    {
        if (request()->ajax()) {
            $row = DataUserModel::where('id', $id)->first();
            $data = [
                'id' => $id,
                'row' => $row,
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.data_user.formeditemail', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function updateEmail(Request $r, $id)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'email' => 'required|email|unique:users,email',
            ], [
                'email.required' => 'Email tidak boleh kosong.',
                'email.unique' => 'Email Sudah di gunakan.',
                'email.email' => 'Format Email Salah.',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                DataUserModel::where('id', $r->id)->update([
                    'email'  => $r->email,
                ]);
                return response()->json(['success' => 'Email Berhasil diubah']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    // password
    public function editResetPassword($id)
    {
        if (request()->ajax()) {
            $row = DataUserModel::where('id', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'title_form' => 'RESSET PASSWORD',
            ];
            return view('private.data_user.formresetpassword', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function updateResetPassword($id)
    {
        if (request()->ajax()) {
            $post = DataUserModel::where('id', $id)->update([
                'password'  => bcrypt('sipora01#@!A'),
                'stts_user'  => 1,
            ]);

            $ids =  $id;
            UserLogModel::create([
                'id_user' => $ids,
                'aktivitas' => 'Reset Password (By Admin).',
            ]);

            return response()->json(['success' => 'Password Berhasil direset']);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
