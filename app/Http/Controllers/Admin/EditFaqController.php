<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditFaqController extends Controller
{
  public function index()
  {
    $faqs = Faq::get();
    return view('admin.faq.index', compact('faqs'));
  }

  public function delete(Faq $faq)
  {
    $faq->delete();

    return back()->with('message', ['text' =>  'Faq deleted successfully!', 'class' => 'success']);
  }
}
