<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class SearchQuestion extends Component
{
  public $search;

  public function render()
  {
    if ($this->search == null) {
      return view('livewire.search-question');
    } else {
      $searchArray = explode(' ', $this->search);
      $questions = Question::where(function ($query) use ($searchArray) {
        foreach ($searchArray as $search) {
          if ($search != null) {
            $query->orWhere('title', 'like', '%' . $search . '%')
              ->orWhere('title_slug', 'like', '%' . $search . '%');
          }
        }
      })->latest()->take(5)->get();
      return view('livewire.search-question', [
        'questions' => $questions,
      ]);
    }
  }
}
