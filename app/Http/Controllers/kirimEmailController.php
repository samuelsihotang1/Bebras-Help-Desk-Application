<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class kirimEmailController extends Controller
{
  public function index()
  {
    $pesan = "<p><b>Hai saudara</b></p>";

    $data_email = [
      'subject' => 'Testing',
      'sender_name' => 'samzam1402@gmail.com',
      'isi' => $pesan
    ];

    Mail::to("samsihotang1@gmail.com")->send(new kirimEmail($data_email));
    return '<h1>Sukses bro</h1>';
    // return view('home');
  }
}
