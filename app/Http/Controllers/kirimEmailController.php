<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class kirimEmailController extends Controller
{
  public function index($email = 'samzam1402@gmail.com')
  {
    // $pesan = Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get();
    // $data_email = [
    //   'subject' => 'Notifikasi',
    //   'sender_name' => 'bebras@bebrasindonesia.org',
    //   'isi' => $pesan
    // ];
    // // return view('mail.kirimEmail', compact('data_email'));
    if (count(Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get()) > 0) {
      Mail::to("$email")->send(new kirimEmail([
        'subject' => 'Notifikasi',
        'sender_name' => 'bebras@bebrasindonesia.org',
        'isi' => Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get()
      ]));
    }
  }
}
