<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAdmin extends Component
{
  public $search;
  public $type;
  public $total_page = 10;

  public function mount($type)
  {
    $this->type = $type;
  }

  public function render()
  {
    if ($this->type == 'all') {
      if (Auth::user()->marker == 'super-admin') {
        $users = User::where('name', 'like', '%' . $this->search . '%')->latest()->take($this->total_page)->get();
        $count = User::where('name', 'like', '%' . $this->search . '%')->count();
      } else {
        $users = User::where('name', 'like', '%' . $this->search . '%')->where('marker', '!=', 'super-admin')->latest()->take($this->total_page)->get();
        $count = User::where('name', 'like', '%' . $this->search . '%')->where('marker', '!=', 'super-admin')->count();
      }
    } elseif ($this->type == 'unapproved') {
      $users = User::where('name', 'like', '%' . $this->search . '%')->where('approved', '=', 'false')->latest()->take($this->total_page)->get();
      $count = User::where('name', 'like', '%' . $this->search . '%')->where('approved', '=', 'false')->count();
    }
    return view('livewire.user-admin', compact('users', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 10;
  }
}
