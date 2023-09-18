<?php

namespace App\Http\Livewire;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotifikasiLivewire extends Component
{
  public $vieeew = 0;
  public $show = '';
  public $aria_expanded = 'false';
  public $notifikasis;

  public function mount()
  {
    $this->notifikasis = Notifikasi::where('user_id', Auth::user()->id)->latest()
      ->get();
  }

  public function render()
  {
    $unviewed = Notifikasi::where('user_id', Auth::user()->id)->where('viewed', 'false')->count();
    return view('livewire.notifikasi-livewire', [
      'unviewed' => $unviewed
    ]);
  }

  public function viewedeeeee()
  {
    foreach ($this->notifikasis as $notifikasi) {
      $notifikasi->viewed = 'true';
      $notifikasi->save();
    }

    if ($this->show == ' show' && $this->aria_expanded == 'true') {
      $this->show = '';
      $this->aria_expanded = 'false';
    } else {
      $this->show = ' show';
      $this->aria_expanded = 'true';
    }
  }
}
