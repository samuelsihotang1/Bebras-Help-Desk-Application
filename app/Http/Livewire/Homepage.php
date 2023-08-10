<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Question;


class Homepage extends Component
{
  public $total_page = 10;

  public function render(Request $request)
  {
    //jika user belum login
    if (!auth()->check()) {
      $answers = Answer::with(['user', 'question'])->latest()->take($this->total_page)->get();
      $count = Answer::with(['user', 'question'])->latest()->count();
      return view('livewire.homepage', compact('answers', 'count'));
    }

    $answers = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
      ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
      ->latest()->take($this->total_page)->get();

    $count = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
      ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
      ->latest()->count();
    return view('livewire.homepage', compact('answers', 'count'));
  }


  //api search
  public function search(Request $request)
  {
    $question = [];

    if ($request->has('q')) {
      $search = $request->q;
      $question = Question::select('title', 'title_slug')->where('title', 'LIKE', "%$search%")->get();
    }

    return response()->json($question);
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
