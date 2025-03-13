<?php

use App\Http\Controllers\PhotoDetailController;
use App\Models\KategoriModel;
use App\Models\LinkTerkaitModel;
use App\Models\PostKategoriRelationshipsModel;
use App\Models\PostModel;
use App\Models\SlideShowModel;
use App\Models\VideoModel;
use Illuminate\Support\Facades\DB;

function getRightData()
{
    //slide
    $resultSlide = SlideShowModel::where('status_actived', '1')->get();

    // populer 
    $populer = PostModel::select('post_kd', 'slug_title', 'post_title', 'tgl_terbit', 'post_content', 'post_thumbnail')
        ->withCount('JPostHistoriCount')
        ->groupBy('post_kd', 'slug_title', 'post_title', 'tgl_terbit', 'post_content', 'post_thumbnail')
        ->orderBy('j_post_histori_count_count', 'desc')
        ->limit(4)
        ->get();



    // kategori
    $kategori = KategoriModel::all();
    $kategoriWithPostCount = $kategori->map(function ($kategori) {
        $RelationshipsCount = PostKategoriRelationshipsModel::where('id_kategori', $kategori->id_kategori)
            ->join('ta_post', 'ta_post.post_kd', '=', 'ta_post_categori_relationships.post_kd')
            ->where('ta_post.post_status', '1')
            ->count();
        $kategori->jumlahCount = $RelationshipsCount;
        return $kategori;
    });
    // link terkait
    $linkTerkait = LinkTerkaitModel::all();
    // arsip
    $arsip = PostModel::select(DB::raw('YEAR(tgl_terbit) AS year, MONTH(tgl_terbit) AS month, COUNT(*) AS count'))
        ->groupBy('year', 'month')
        ->orderByDesc('year')
        ->orderByDesc('month')
        ->get();

    // galeri
    $resultPhoto = DB::table('ddd_galeri_photo_detail')
        ->join('ddd_galeri_photo', 'ddd_galeri_photo.id_galeri_photo', '=', 'ddd_galeri_photo_detail.id_galeri_photo')
        ->get();

    // video 
    $resultVideo = VideoModel::all();

    // return
    return [
        'resultSlide' => $resultSlide,
        'kategori' => $kategoriWithPostCount,
        'linkTerkait' => $linkTerkait,
        'arsip' => $arsip,
        'resultPhoto' => $resultPhoto,
        'resultVideo' => $resultVideo,
        'populer' => $populer,
    ];
}
