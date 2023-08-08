<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Answer;

class AnswerAdmin extends Component
{
  public $type;
  public $total_page = 1;

  public function mount($type)
  {
    $this->type = $type;
  }

  public function render()
  {
    if ($this->type == 'all') {
      $answers = Answer::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->latest()->take($this->total_page)->get();
      $count = Answer::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->count();
    } elseif ($this->type == 'reported') {
      $answers = Answer::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->withCount('report_users')->orderBy('report_users_count', 'desc')->take($this->total_page)->get();
      $count = Answer::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->withCount('report_users')->orderBy('report_users_count', 'desc')->count();
    }
    return view('livewire.answer-admin', compact('answers', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 1;
  }
}
