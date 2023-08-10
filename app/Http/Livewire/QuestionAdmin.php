<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuestionAdmin extends Component
{
  public $type;
  public $total_page = 10;

  public function mount($type)
  {
    $this->type = $type;
  }

  public function render()
  {
    if ($this->type == 'all') {
      $questions = Question::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->latest()->take($this->total_page)->get();
      $count = Question::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->latest()->count();
    } elseif ($this->type == 'reported') {
      $questions = Question::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->withCount('report_users')->orderBy('report_users_count', 'desc')->take($this->total_page)->get();

      $count = Question::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->withCount('report_users')->orderBy('report_users_count', 'desc')->count();
    }
    return view('livewire.question-admin', compact('questions', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
