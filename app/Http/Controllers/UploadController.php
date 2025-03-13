<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\UploadModel;
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

    public function storeUpload(Request $r)
    {
        if (request()->ajax()) {
            $r->validate([
                'file_dokumen' =>  'required|file|mimes:pdf,docx,xlsx,pptx|max:10000',
            ], [
                'file_dokumen.required' => 'File Dokumen Tidak Boleh Kosong',
                'file_dokumen.mimes' => 'File Hanya di perbolehkan ekstensi pdf,docx,xlsx,pptx',
            ]);

            $file_name = "";
            if ($file = $r->file('file_dokumen')) {
                $file_path = public_path('upload/file_biodata');
                $file_ekstensi = $file->getClientOriginalExtension();
                $file_name = date('ymdhis') . "." . $file_ekstensi;
                $file->move($file_path, $file_name);
            }


            $post = UploadModel::create([
                'file_dokumen'   => $file_name,
                'jenis_dok' => $r->jenis_dok,
                'id_biodata' => $r->id_biodata,
            ]);
            if ($post = true) {
                return response()->json(['success' => 'Data berhasil diupload', 'action' => 'upload']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function updateUpload(Request $r, $id)
    {
        if (request()->ajax()) {
            $r->validate([
                'file_dokumen' =>  'required|file|mimes:pdf,docx,xlsx,pptx|max:10000',
            ], [
                'file_dokumen.required' => 'File Dokumen Tidak Boleh Kosong',
                'file_dokumen.mimes' => 'File Hanya di perbolehkan ekstensi pdf,docx,xlsx,pptx',
            ]);

            // $row = UploadModel::where('id_biodata', $id)->where('jenis_dok', $r->jenis_dok)->first();
            // $imagePath = public_path('upload/file_biodata') . '/' . $row->file_dokumen;
            // if (file_exists($imagePath)) {
            //     unlink($imagePath);
            // }



            $file_name = "";
            if ($file = $r->file('file_dokumen')) {
                $file_path = public_path('upload/file_biodata');
                $file_ekstensi = $file->getClientOriginalExtension();
                $file_name = date('ymdhis') . "." . $file_ekstensi;
                $file->move($file_path, $file_name);
            }


            $post = UploadModel::where('id_biodata', $id)->where('jenis_dok', $r->jenis_dok)->update([
                'file_dokumen'   => $file_name,
            ]);
            if ($post = true) {
                return response()->json(['success' => 'Data berhasil diupload', 'action' => 'upload']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function destroy($id)
    {
        if (request()->ajax()) {


            $row = UploadModel::where('id_upload_dok', $id)->first();
            $imagePath = public_path('upload/file_biodata') . '/' . $row->file_dokumen;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            UploadModel::where('id_upload_dok', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil dihapus',
                'action' => 'upload'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
