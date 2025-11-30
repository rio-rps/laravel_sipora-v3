<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\UploadModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showUploadDokumenBiodata($id)
    {
        if (request()->ajax()) {

            $id = getIdUser();
            $rowBiodata = BiodataModel::where('id_user', $id)->first();

            if (empty($rowBiodata)) {
                $row = 'kosong';
                $row2 = 'kosong';
                $row3 = 'kosong';
                $row4 = 'kosong';
            } else {
                $row = UploadModel::where('id_biodata', $rowBiodata->id_biodata)->where('jenis_dok', '1')->first();
                $row2 = UploadModel::where('id_biodata', $rowBiodata->id_biodata)->where('jenis_dok', '2')->first();
                $row3 = UploadModel::where('id_biodata', $rowBiodata->id_biodata)->where('jenis_dok', '3')->first();
                $row4 = UploadModel::where('id_biodata', $rowBiodata->id_biodata)->where('jenis_dok', '4')->first();
            }
            $data = [
                'row' => $row,
                'row2' => $row2,
                'row3' => $row3,
                'row4' => $row4,
                'biodata' => $rowBiodata
            ];
            return view('private.biodata.data_upload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function createUpload(Request $r)
    {
        if (request()->ajax()) {
            $cek = UploadModel::where('id_biodata', $r->id_biodata)->where('jenis_dok', $r->jenis_dok)->count();

            $data = [
                'title_form' => 'FORM UPLOAD DOKUMEN',
                'jenis_dok' => $r->jenis_dok,
                'id' => $r->id_biodata,
                'action' => $cek
            ];
            return view('private.biodata.formupload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function storeUpload(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'file_dokumen' => 'required|file|max:500|mimes:pdf,docx,xlsx,pptx',
            ], [
                'file_dokumen.required' => 'File Dokumen Tidak Boleh Kosong',
                'file_dokumen.mimes' => 'File Hanya di perbolehkan ekstensi pdf,docx,xlsx,pptx',
            ]);


            if ($request->hasFile('file_dokumen')) {
                $file = $request->file('file_dokumen');

                // 1. Validasi MIME asli file
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $realMime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                $allowedMime = [
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',       // .xlsx
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation', // .pptx
                ];

                if (!in_array($realMime, $allowedMime)) {


                    $ids =  getIdUser();
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Gagal Upload Dokumen ' . uploadFile($request->jenis_dok) . ' (Tipe MIME file tidak diizinkan).',
                    ]);

                    return response()->json(['error' => 'Tipe MIME file tidak diizinkan'], 422);
                }

                // 2. Validasi ekstensi asli (bukan dari manipulasi)
                $extension = strtolower($file->getClientOriginalExtension());
                $allowedExt = ['pdf', 'docx', 'xlsx', 'pptx'];

                if (!in_array($extension, $allowedExt)) {

                    $ids =  getIdUser();
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Gagal Upload Dokumen ' . uploadFile($request->jenis_dok) . ' (Ekstensi file tidak valid).',
                    ]);

                    return response()->json(['error' => 'Ekstensi file tidak valid'], 422);
                }

                // 3. Cek isi file apakah mengandung kode PHP
                $contents = file_get_contents($file->getPathname());
                if (stripos($contents, '<?php') !== false || stripos($contents, 'eval(') !== false) {

                    $ids =  getIdUser();
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Gagal Upload Dokumen ' . uploadFile($request->jenis_dok) . ' (file mencurigakan, upload ditolak).',
                    ]);

                    return response()->json(['error' => 'Isi file mencurigakan, upload ditolak'], 422);
                }

                // Simpan file
                $file_path = public_path('upload/file_biodata');
                $file_name = now()->format('ymdHis') . '_' . uniqid() . '.' . $extension;
                $file->move($file_path, $file_name);



                UploadModel::create([
                    'file_dokumen' => $file_name,
                    'jenis_dok'    => $request->jenis_dok,
                    'id_biodata'   => $request->id_biodata,
                ]);

                if ($post = true) {

                    $ids =  getIdUser();
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Berhasil Upload Dokumen ' . uploadFile($request->jenis_dok) . ' (Create).',
                    ]);


                    return response()->json(['success' => 'Data berhasil diupload', 'action' => 'upload']);
                }
            }
        }

        abort(403);
    }

    // public function updateUpload(Request $r, $id)
    // {
    //     if (request()->ajax()) {
    //         $r->validate([
    //             'file_dokumen' =>  'required|file|mimes:pdf,docx,xlsx,pptx|max:10000',
    //         ], [
    //             'file_dokumen.required' => 'File Dokumen Tidak Boleh Kosong',
    //             'file_dokumen.mimes' => 'File Hanya di perbolehkan ekstensi pdf,docx,xlsx,pptx',
    //         ]);

    //         // $row = UploadModel::where('id_biodata', $id)->where('jenis_dok', $r->jenis_dok)->first();
    //         // $imagePath = public_path('upload/file_biodata') . '/' . $row->file_dokumen;
    //         // if (file_exists($imagePath)) {
    //         //     unlink($imagePath);
    //         // }



    //         $file_name = "";
    //         if ($file = $r->file('file_dokumen')) {
    //             $file_path = public_path('upload/file_biodata');
    //             $file_ekstensi = $file->getClientOriginalExtension();
    //             $file_name = date('ymdhis') . "." . $file_ekstensi;
    //             $file->move($file_path, $file_name);
    //         }


    //         $post = UploadModel::where('id_biodata', $id)->where('jenis_dok', $r->jenis_dok)->update([
    //             'file_dokumen'   => $file_name,
    //         ]);
    //         if ($post = true) {
    //             return response()->json(['success' => 'Data berhasil diupload', 'action' => 'upload']);
    //         }
    //     } else {
    //         exit('Maaf Tidak Dapat diproses...');
    //     }
    // }


    public function destroy($id)
    {
        if (request()->ajax()) {


            $row = UploadModel::where('id_upload_dok', $id)->first();
            $imagePath = public_path('upload/file_biodata') . '/' . $row->file_dokumen;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $row = UploadModel::where('id_upload_dok', $id)->first();


            UploadModel::where('id_upload_dok', $id)->delete();


            $ids =  getIdUser();
            UserLogModel::create([
                'id_user' => $ids,
                'aktivitas' => 'Berhasil Hapus Data ' . uploadFile($row->jenis_dok) . ' (Destroy).',
            ]);


            return response()->json([
                'success' => 'Data berhasil dihapus',
                'action' => 'upload'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
