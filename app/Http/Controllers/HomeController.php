<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth','verified']);
  }


  public function index(Request $request)
  {
    //jika user belum disetujui
    if (auth()->check() && auth()->user()->approved == 'false') {
      auth()->logout();
      return redirect()->route('login')->with('message', ['text' => 'Akun anda belum disetujui', 'class' => 'danger']);
    } elseif (auth()->check() && auth()->user()->approved == 'true') {
      $answers = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
        ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
        ->latest()->get();
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
