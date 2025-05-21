<?php

use App\Models\BiodataModel;
use App\Models\UserAktivasiAkunModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

if (!function_exists('getIdUser')) {
    function getIdUser()
    {
        return Auth::user()->id;
    }
}

if (!function_exists('getLevel')) {
    function getLevel()
    {
        return Auth::user()->level;
    }
}

if (!function_exists('getIdBiodata')) {
    function getIdBiodata()
    {
        $id_user = Auth::user()->id;
        return BiodataModel::where('id_user', $id_user)->first()->id_biodata;
    }
}



function cek_date_ddmmyyyy_his_v1($date)
{
    $timestamp = $date;
    $splitTimeStamp = explode(" ", $timestamp);
    $date = $splitTimeStamp[0];
    $time = isset($splitTimeStamp[1]) ? $splitTimeStamp[1] : ''; // tambahkan pengecekan ini

    $str = explode('-', $date);
    $bulan = array(
        '00' => '00',
        '01' => '01',
        '02' => '02',
        '03' => '03',
        '04' => '04',
        '05' => '05',
        '06' => '06',
        '07' => '07',
        '08' => '08',
        '09' => '09',
        '10' => '10',
        '11' => '11',
        '12' => '12'
    );
    return $str['2'] . "-" . $bulan[$str[1]] . "-" . $str[0] . " (" . $time . ")";
}

function cek_date_ddmmyyyy_his_v2($date)
{
    $timestamp = $date;
    $splitTimeStamp = explode(" ", $timestamp);
    $date = $splitTimeStamp[0];
    $time = isset($splitTimeStamp[1]) ? $splitTimeStamp[1] : ''; // tambahkan pengecekan ini

    $str = explode('-', $date);
    $bulan = array(
        '00' => '00',
        '01' => '01',
        '02' => '02',
        '03' => '03',
        '04' => '04',
        '05' => '05',
        '06' => '06',
        '07' => '07',
        '08' => '08',
        '09' => '09',
        '10' => '10',
        '11' => '11',
        '12' => '12'
    );
    return $str['2'] . "-" . $bulan[$str[1]] . "-" . $str[0];
}

function cek_month_v1($month)
{
    $bulan = array(
        '0' => '00',
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $bulan[$month];
}

function cek_ddmmyy_v1($date)
{
    $str = explode('-', $date);
    $bulan = array(
        '00' => '00',
        '01' => '01',
        '02' => '02',
        '03' => '03',
        '04' => '04',
        '05' => '05',
        '06' => '06',
        '07' => '07',
        '08' => '08',
        '09' => '09',
        '10' => '10',
        '11' => '11',
        '12' => '12'
    );
    return $str['2'] . "-" . $bulan[$str[1]] . "-" . $str[0];
}

function cek_ddmmyy_v2($date)
{
    $str = explode('-', $date);
    $bulan = array(
        '00' => '00',
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $str['2'] . " " . $bulan[$str[1]] . " " . $str[0];
}


function cek_ddmmyy_v4($date)
{
    $str = explode('-', $date);
    $bulan = array(
        '00' => '00',
        '01' => 'JANUARI',
        '02' => 'FEBRUARI',
        '03' => 'MARET',
        '04' => 'APRIL',
        '05' => 'MEI',
        '06' => 'JUNI',
        '07' => 'JULI',
        '08' => 'AGUSTUS',
        '09' => 'SEPTEMBER',
        '10' => 'OKTOBER',
        '11' => 'NOVEMBER',
        '12' => 'DESEMBER'
    );
    return   $bulan[$str[1]] . " " . $str[0];
}

function cek_ddmmyy_v3($tanggal)
{
    return date('M d, Y', strtotime($tanggal));
}


function format_rupiah($angka)
{
    $hasil =  number_format($angka, 0, ',', '.');
    return $hasil;
}

function status_actived($angka)
{
    if ($angka == 1) {
        $isi = "Aktif";
    } elseif ($angka == 2) {
        $isi = "Tidak Aktif";
    }
    return $isi;
}

function level($angka)
{
    if ($angka == 1) {
        $isi = "Admin";
    } elseif ($angka == 2) {
        $isi = "KIR";
    } elseif ($angka == 3) {
        $isi = "Pengguna / Client";
    }
    return $isi;
}

function uploadFile($angka)
{
    if ($angka == 1) {
        $isi = "NIB";
    } elseif ($angka == 2) {
        $isi = "KTP";
    } elseif ($angka == 3) {
        $isi = "AKTE PENDIRIAN";
    } elseif ($angka == 4) {
        $isi = "NPWP";
    } elseif ($angka == 5) {
        $isi = "KIR";
    } elseif ($angka == 6) {
        $isi = "STNK";
    }
    return $isi;
}


function status_permohonan($angka)
{
    if ($angka == 1) {
        $isi = '<span class="badge badge-warning">Draft</span>';
    } elseif ($angka == 2) {
        $isi = '<span class="badge badge-primary">Mengirim</span>';
    } elseif ($angka == 3) {
        $isi = '<span class="badge badge-danger">Ditolak</span>';
    } elseif ($angka == 4) {
        $isi = '<span class="badge badge-green">Diproses</span>';
    } elseif ($angka == 5) {
        $isi = '<span class="badge badge-success">Disetujui</span>';
    }
    return $isi;
}

function act($act)
{
    if ($act == 'Input') {
        $isi = 'DATA PENGAJUAN PERMOHONAN (MENGIRIM PERMOHONAN)';
    } elseif ($act == 'Histori') {
        $isi = 'DATA HISTORI PERMOHONAN';
    } elseif ($act == 'Masuk') {
        $isi = 'DATA PENGAJUAN PERMOHONAN (MASUK)';
    } elseif ($act == 'Proses') {
        $isi = 'DATA PENGAJUAN PERMOHONAN (PROSES)';
    } elseif ($act == 'HistoriPengawas') {
        $isi = 'DATA KARTU PENGAWAS (TELAH DIPROSES / FINAL)';
    }
    return $isi;
}
// function AktivasiAkunHelper()
// {
//     $user = Auth::user();
//     if ($user->level == 3) {
//         $cek = UserAktivasiAkunModel::where('id_user', $user->id)->count();
//         if ($cek == 0) {
//             $a =  redirect()->intended('/aktivasiAkun');
//         }
//     }
//     return  $a;
// }


function cek_status_permohonan($angka)
{
    if ($angka == 1) {
        $isi = "DRAFT";
    } elseif ($angka == 2) {
        $isi = "MASUK";
    } elseif ($angka == 4) {
        $isi = "PROSES";
    } elseif ($angka == 5) {
        $isi = "SELESAI";
    }
    return $isi;
}
