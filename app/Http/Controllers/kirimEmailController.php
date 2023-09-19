<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class kirimEmailController extends Controller
{
  public function index()
  {
    // $pesan = Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'true')->get();
    // $data_email = [
    //   'subject' => 'Notifikasi dari Bebras Help Desk',
    //   'sender_name' => 'bebras@bebrasindonesia.org',
    //   'isi' => $pesan
    // ];
    // // return view('mail.kirimEmail', compact('data_email'));
    // Mail::to("$email")->send(new kirimEmail($data_email));


    Mail::to(auth()->user()->email)->send(new kirimEmail([
      'subject' => 'Notifikasi dari Bebras Help Desk',
      'sender_name' => 'bebras@bebrasindonesia.org',
      'isi' => Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get()
    ]));
  }
}
