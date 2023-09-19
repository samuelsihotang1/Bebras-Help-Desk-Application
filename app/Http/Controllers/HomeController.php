<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Notifikasi;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }


  public function index(Request $request)
  {
    //jika user belum disetujui
    if (auth()->check() && auth()->user()->approved == 'false') {
      auth()->logout();
      return redirect()->route('login')->with('message', ['text' => 'Anda belum bisa masuk, sebelum akun anda disetujui oleh admin. Harap menunggu.']);
    } elseif (auth()->check() && auth()->user()->approved == 'true') {
      $answers = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
        ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
        ->latest()->get();

      if (!Cache::has('email_notification_' . auth()->user()->id)) {
        $notif = Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get();
        if (count($notif) > 0) {
          Mail::to(auth()->user()->email)->send(new kirimEmail([
            'subject' => 'Notifikasi dari Bebras Help Desk',
            'sender_name' => 'bebras@bebrasindonesia.org',
            'isi' => $notif
          ]));
          Cache::put('email_notification_' . auth()->user()->id, true, 86400);
        }
      }
      return view('home', compact('answers'));
    }

    //jika user belum login
    // if (!auth()->check()) {
    //     $answers = Answer::with(['user', 'question'])->latest()->get();
    //     return view('home', compact('answers'));
    // }
  }

  public function search(Request $request)
  {
    if ($request->search == null) {
      return view('search-results');
    } else {
      $searchArray = explode(' ', $request->search);
      $questions = Question::where(function ($query) use ($searchArray) {
        foreach ($searchArray as $search) {
          if ($search != null) {
            $query->orWhere('title', 'like', '%' . $search . '%')
              ->orWhere('title_slug', 'like', '%' . $search . '%');
          }
        }
      })->latest()->get();
      return view('search-results', [
        'questions' => $questions,
        'search' => $request->search
      ]);
    }
  }
}
