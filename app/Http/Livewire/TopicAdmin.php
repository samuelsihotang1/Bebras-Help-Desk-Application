<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topic;

class TopicAdmin extends Component
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
      $topics = Topic::whereNull('status')->orWhere('status', 'updated_by_user')->latest()->take($this->total_page)->get();
      $count = Topic::whereNull('status')->orWhere('status', 'updated_by_user')->count();
    }
    return view('livewire.topic-admin', compact('topics', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
