<?php

namespace App\View\Components;

use App\Models\Faq;
use Illuminate\View\Component;

class AdminFaqs extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    $faqs = Faq::count();
    return view('components.admin-faqs', [
      'faqs' => $faqs
    ]);
  }
}