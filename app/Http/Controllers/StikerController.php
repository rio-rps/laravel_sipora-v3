<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class StikerController extends Controller
{
    public function generateImage(Request $request)
    {
        $manager = new ImageManager(new Driver());

        // Load gambar dasar (STICKER.png)
        $imagePath = public_path("asset('images/kartu/bg1/STICKER.png')");
        $image = $manager->read($imagePath);

        // Tambahkan teks ke gambar
        $image->text('ANGKUTAN ORANG AJDP', 200, 50, function ($font) {
            $font->file(public_path('fonts/Arial-Bold.ttf')); // pastikan font ada
            $font->size(25);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
        });

        $image->text('PT SUMSEL MAKMUR TRANSPORT', 200, 80, function ($font) {
            $font->file(public_path('fonts/Arial-Bold.ttf'));
            $font->size(15);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
        });

        $image->text('BG 1234 ZZ', 30, 205, function ($font) {
            $font->file(public_path('fonts/Arial-Bold.ttf'));
            $font->size(14);
            $font->color('#000');
        });

        $image->text('TNKB', 350, 205, function ($font) {
            $font->file(public_path('fonts/Arial-Bold.ttf'));
            $font->size(15);
            $font->color('#000');
        });

        // Simpan ke file sementara
        $filename = 'stiker_' . time() . '.png';
        $filePath = public_path('temp/' . $filename);
        $image->save($filePath);

        return response()->json([
            'url' => asset('temp/' . $filename),
            'filename' => $filename
        ]);
    }
}
