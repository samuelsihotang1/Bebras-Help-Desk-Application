<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditFaqController extends Controller
{
  public function index()
  {
    $faqs = Faq::latest()->get();
    return view('admin.faq.index', compact('faqs'));
  }

  public function delete(Faq $faq)
  {
    $faq->delete();

    return back()->with('message', ['text' =>  'FAQ berhasil dihapus dengan sukses!', 'class' => 'success']);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'text' => 'required',
    ]);

    Faq::create([
      'title' => $request->title,
      'text' => $request->text,
    ]);

    return back()->with('message', ['text' =>  'FAQ berhasil ditambahkan dengan sukses!', 'class' => 'success']);
  }

  public function update(Request $request)
  {
    $faq = Faq::find($request->faq);
    if ($request->title) {
      $request->validate([
        'title' => 'required'
      ]);

      $faq->update([
        'title' => $request->title,
      ]);
    }

    if ($request->text) {

      $request->validate([
        'text' => 'required'
      ]);

      $faq->update([
        'text' => $request->text,
      ]);
    }

    return back()->with('message', ['text' =>  'FAQ berhasil diperbarui dengan sukses!', 'class' => 'success']);
  }
}
