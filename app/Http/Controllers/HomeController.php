<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{


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


  //api search


  public function search(Request $request)
  {
    $questions = [];

    if ($request->has('q')) {
      $searchTerms = explode(' ', $request->q); // pecah inputnbya berdasarkan spasi

      $query = Question::select('title', 'title_slug');
      foreach ($searchTerms as $term) {
        $query->orWhere('title', 'LIKE', "%{$term}%"); // cari setiap kata dalam title
      }

      $questions = $query->get();
    }

    return response()->json($questions);
  }

}