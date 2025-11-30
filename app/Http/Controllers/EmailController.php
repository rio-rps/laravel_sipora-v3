<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function kirimUjiEmail()
    {
        try {
            Mail::raw('Ini adalah email uji coba dari ...', function ($message) {
                $message->to('sipora.sumselprov@gmail.com')
                    ->subject('Uji Coba Kirim Email =..')
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return "✅ Email berhasil dikirim!";
        } catch (\Exception $e) {
            return "❌ Gagal mengirim email: " . $e->getMessage();
        }
    }
}
