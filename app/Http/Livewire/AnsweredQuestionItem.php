<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Answer;

class AnsweredQuestionItem extends Component
{
  public $question;
  public $answer;

  public function mount($answer)
  {
    $this->answer = $answer;
  }

  public function render()
  {
    $user_id = auth()->id();
    views($this->answer)
      ->cooldown(86400)
      ->record();

    return view('livewire.answered-question-item', [
      'answer' => $this->answer,
      'user_id' => $user_id,
    ]);
  }
}
