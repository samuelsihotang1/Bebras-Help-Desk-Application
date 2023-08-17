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
      $questions = Question::where('title', 'like', '%' . $this->search . '%')
        ->orWhere('title_slug', 'like', '%' . $this->search . '%')
        ->latest()->take(5)->get();
      return view('livewire.search-question', [
        'questions' => $questions,
      ]);
    }
  }
}
