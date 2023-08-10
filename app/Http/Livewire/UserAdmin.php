<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
      if (Auth::user()->marker == 'super-admin') {
        $users = User::latest()->take($this->total_page)->get();
        $count = User::count();
      } else {
        $users = User::where('marker', '!=', 'super-admin')->latest()->take($this->total_page)->get();
        $count = User::where('marker', '!=', 'super-admin')->count();
      }
    } elseif ($this->type == 'unapproved') {
      $users = User::where('approved', '=', 'false')->latest()->take($this->total_page)->get();
      $count = User::where('approved', '=', 'false')->count();
    }
    return view('livewire.user-admin', compact('users', 'count'));
  }

  public function morePage()
  {
    $this->total_page += 1;
  }
}
