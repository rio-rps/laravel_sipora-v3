<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\DataUserModel;
use App\Models\UnitBidangModel;
use App\Models\UserDataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class DataUserController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'DATA USER',
        ];
        return view('private/data_user/view')->with($data);
    }


    public function create()
    {
        if (request()->ajax()) {
            $dt = DataUserModel::all();
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
            ];
            return view('private.datauser.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


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
                'level' => 'required',
            ], [
                'name.required' => 'Nama tidak boleh kosong.',
                'email.required' => 'Email tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'level.required' => 'Akses level tidak boleh kosong.',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = DataUserModel::create([
                    'name' => $r->name,
                    'email '  => $r->email,
                    'password'  => bcrypt('123456'),
                    'level' => $r->level,
                ]);
                return response()->json(['success' => 'Data berhasil disimpan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
    public function show($id)
    {
        if (request()->ajax()) {
            return  DataTables::of(DataUserModel::query())
                ->addColumn('action', 'private.data_user.action')
                ->addColumn('level', function ($row) {
                    return level($row->level);
                })
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


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
                'password'  => bcrypt('123456'),
            ]);
            return response()->json(['success' => 'Password Berhasil direset']);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }



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


    public function viewBiodata($id)
    {
        $data = [
            'title' => 'DATA BIODATA',
            'row' => BiodataModel::where('id_user', $id)->first()
        ];
        return view('private/data_user/biodata')->with($data);
    }


    // public function viewBiodata($id)
    // {
    //     if (request()->ajax()) {
    //         $row = DataUserModel::where('id', $id)->first();
    //         $data = [
    //             'id' => $id,
    //             'row' => $row,
    //             'title_form' => 'BIODATA',
    //             'biodata' => BiodataModel::where('id_user', $id)
    //         ];
    //         return view('private.data_user.formviewbiodata', $data);
    //     } else {
    //         exit('Maaf, request tidak dapat diproses');
    //     }
    // }

    // public function index()
    // {
    //     $data = [
    //         'title' => 'DATA BIODATA',
    //         'id_user' => Auth::user()->id,
    //     ];
    //     return view('private/biodata/view')->with($data);
    // }


    // public function username($id)
    // {
    //     if (request()->ajax()) {
    //         $row = UserDataModel::where('id', $id)->first();
    //         $data = [
    //             'id' => $id,
    //             'row' => $row,
    //             'title_form' => 'FORM EDIT DATA USERNAME',
    //         ];
    //         return view('data.user.formeditusername', $data);
    //     } else {
    //         exit('Maaf, request tidak dapat diproses');
    //     }
    // }

    // public function password($id)
    // {
    //     if (request()->ajax()) {
    //         $row = UserDataModel::where('id', $id)->first();
    //         $data = [
    //             'id' => $id,
    //             'row' => $row,
    //             'title_form' => 'FORM EDIT DATA PASSWORD',
    //         ];
    //         return view('data.user.formeditpassword', $data);
    //     } else {
    //         exit('Maaf, request tidak dapat diproses');
    //     }
    // }

    // public function update(Request $r, $id)
    // {
    //     $validator = Validator::make($r->all(), [
    //         'name' => 'required',
    //     ], [
    //         'name.required' => 'Nama Tidak Boleh Kosong.',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json(['errors' => $errors], 422);
    //     } else {
    //         UserDataModel::where('id', $id)->update([
    //             'name' => $r->name,
    //         ]);
    //         return response()->json(['success' => 'Data berhasil diupdate']);
    //     }
    // }

    // public function updateusername(Request $r, $id)
    // {
    //     $validator = Validator::make($r->all(), [
    //         'username' => [
    //             'required',
    //             function ($attribute, $value, $fail) {
    //                 $isUnique = UserDataModel::where('username', $value)
    //                     ->where('tahun', getTahunLogin())
    //                     ->count() === 0;
    //                 if (!$isUnique) {
    //                     $fail('Username sudah digunakan Tahun ' . getTahunLogin());
    //                 }
    //             }
    //         ],
    //     ], [
    //         'username.required' => 'Username tidak boleh kosong.',
    //         'username.unique' => 'Username sudah digunakan.',
    //     ]);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json(['errors' => $errors], 422);
    //     } else {
    //         UserDataModel::where('id', $id)->update([
    //             'username' => $r->username,
    //         ]);
    //         return response()->json(['success' => 'Data berhasil diupdate']);
    //     }
    // }

    // public function updatepassword(Request $r, $id)
    // {
    //     $validator = Validator::make($r->all(), [
    //         'password' => 'required|min:6|confirmed',
    //     ], [
    //         'password.required' => 'Password tidak boleh kosong.',
    //         'password.min' => 'Password Minimal 6 Karakter.',
    //         'password.confirmed' => 'Ulangi Password tidak sama.',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json(['errors' => $errors], 422);
    //     } else {
    //         UserDataModel::where('id', $id)->update([
    //             'password' => bcrypt($r->password),
    //         ]);
    //         return response()->json(['success' => 'Data berhasil diupdate']);
    //     }
    // }



    // public function ubahpassword()
    // {
    //     $data = [
    //         'title' => 'UBAH PASSWORD',
    //     ];
    //     return view('data/pengaturan_profil_user/ubahpassword')->with($data);
    // }

    // public function destroy(Request $r)
    // {
    //     if (request()->ajax()) {
    //         // $cek = MappingNPDDokumenModel::where('id_jenis_npd', $r->id)->get();
    //         // if (count($cek) > 0) {
    //         //     return response()->json(['error' => 'Tidak Dapat di Hapus, Data Sudah dipakai / Hubungi Admin']);
    //         // } else {
    //         UserDataModel::where('id', $r->id, 'tahun', getTahunLogin())->delete();
    //         return response()->json(['success' => 'Data Berhasil dihapus']);
    //         //}
    //     } else {
    //         exit('Maaf Tidak Dapat diproses...');
    //     }
    // }

    // public function updatepassworduser(Request $r)
    // {
    //     $validator = Validator::make($r->all(), [
    //         'password_old' => 'required',
    //         'password_new' => 'required|min:6|confirmed',
    //     ], [
    //         'password_old.required' => 'Password Lama tidak boleh kosong.',
    //         'password_new.required' => 'Password Baru tidak boleh kosong.',
    //         'password_new.min' => 'Password Minimal 6 Karakter.',
    //         'password_new.confirmed' => 'Password baru dan confirm tidak sama.',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json(['errors' => $errors], 422);
    //     } else {
    //         $userdata = UserDataModel::find($r->id, 'tahun', getTahunLogin());

    //         // Mengecek apakah password lama yang dimasukkan benar atau tidak
    //         if (Auth::attempt(['username' => $userdata->username, 'password' => $r->password_old, 'tahun' => getTahunLogin()])) {
    //             UserDataModel::where('id', $r->id, 'tahun', getTahunLogin())->update([
    //                 'password' => bcrypt($r->password_new),
    //             ]);
    //             return response()->json(['success' => 'Data berhasil Reset', 'route' => route('logout')]);
    //         } else {
    //             return response()->json(['errors' => ['password_old' => ['Password Lama Salah']]], 422);
    //         }
    //     }
    // }
}
