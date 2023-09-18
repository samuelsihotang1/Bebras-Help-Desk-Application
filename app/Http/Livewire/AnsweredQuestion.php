<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Answer;

class AnsweredQuestion extends Component
{
  public $total_page = 10;
  public $question;

  public function mount($question)
  {
    $this->question = $question;
  }

  public function render()
  {
    $user_id = auth()->id();
    $answers = Answer::with('user')
      ->where('question_id', $this->question->id)
      ->where('id', '<>', $this->question->pin_answer)
      ->latest()
      ->take($this->total_page)
      ->get();

    if ($this->question->pin_answer) {
      $answers->prepend(Answer::where('id', $this->question->pin_answer)->first());
    }

    // $answers = Answer::with('user');
    // foreach $tokens as token 
    // {
    //   $answers->OrWhere('title', $this->question->id);
    // }
    // $answers->get

    $count = Answer::with('user')->where('question_id', $this->question->id)->count();

    foreach ($answers as $answer) {
      views($answer)
        ->cooldown(86400)
        ->record();
    }

    return view('livewire.answered-question', compact('answers', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
