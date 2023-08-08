<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserAdmin extends Component
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
      $users = User::latest()->take($this->total_page)->get();
      $count = User::count();
    }
    return view('livewire.user-admin', compact('users', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 1;
  }
}
