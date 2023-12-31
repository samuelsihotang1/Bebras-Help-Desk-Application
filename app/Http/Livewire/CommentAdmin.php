<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentAdmin extends Component
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
      $comments = Comment::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->latest()->take($this->total_page)->get();
      $count = Comment::doesnthave('report_users')->whereNull('status')->orWhere('status', 'updated_by_user')->count();
    } elseif ($this->type == 'reported') {
      $comments = Comment::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->whereNull('status')->withCount('report_users')->orderBy('report_users_count', 'desc')->take($this->total_page)->get();
      $count = Comment::has('report_users')->with(['report_users' => function ($q) {
        $q->distinct()->get();
      }])->whereNull('status')->withCount('report_users')->orderBy('report_users_count', 'desc')->count();
    }
    return view('livewire.comment-admin', compact('comments', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
