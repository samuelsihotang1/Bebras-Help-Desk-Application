<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuestionToAnswer extends Component
{
  public $total_page = 10;

  public function render()
  {
    $questions = Question::where('user_id', '!=', auth()->id())->latest()->take($this->total_page)->get();
    $count = Question::where('user_id', '!=', auth()->id())->latest()->count();
    return view('livewire.question-to-answer', compact('questions', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
