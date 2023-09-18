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

    $follow = auth()->user()->followings;
    $answers1 = Answer::where('user_id', '!=', auth()->id())
      ->where(function ($query) use ($follow) {
        foreach ($follow as $value) {
          if ($value != null) {
            $query->where('user_id', '!=', $value->followable_id);
          }
        }
      })->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
      ->latest()->get();

    // foreach ($follow as $value) {
    //   $n_answeeer = Answer::where('user_id', '!=', auth()->id())->where('user_id', '=', $value->followable_id)
    //     ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
    //     ->latest()->get();
    //     foreach ($n_answeeer as $key) {
    //       $answers->prepend($key);
    //     }
    //   // $answers->prepend(Answer::where('user_id', '!=', auth()->id())->where('user_id', '=', $value->followable_id)
    //   //   ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
    //   //   ->latest()->get());
    // } //work

    // $answers = Answer::where('user_id', '!=', auth()->id())
    //   ->where(function ($query) use ($follow) {
    //     foreach ($follow as $value) {
    //       if ($value != null) {
    //         $query->orWhere('user_id', '=', $value->followable_id);
    //       }
    //     }
    //   })->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
    //   ->latest()->get();
    if (count($follow) > 0) {
      $answers2 = Answer::where('user_id', '!=', auth()->id())
        ->where(function ($query) use ($follow) {
          foreach ($follow as $value) {
            if ($value != null) {
              $query->orWhere('user_id', '=', $value->followable_id);
            }
          }
        })->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
        ->latest()->get();
      $answers = $answers2->concat($answers1)->sortByDesc('created_at')->take($this->total_page);
    } else {
      $answers = $answers1->sortByDesc('created_at')->take($this->total_page);
    }

    // \dd($answers);

    $count = $answers->count();
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
