<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;


class AboutController extends Controller
{
  public function index()
  {
    $about = About::first();
    return view('about.index', [
      'title' => $about->title,
      'desc' => $about->description,
      'img' => $about->img
    ]);
  }

  public function updateAbout(Request $request)
  {
    $about = about::first();
    if ($request->type == 'title') {
      $request->validate([
        'title' => 'required|max:100',
      ]);
      $about->update([
        'title' => $request->title
      ]);
    } else if ($request->type == 'desc') {
      $request->validate([
        'desc' => 'required|max:4096',
      ]);
      $about->update([
        'description' => $request->desc
      ]);
    } else if ($request->type == 'image') {
      $imageName = $this->storeImage($request);

      if ($about->img) {
        File::delete('img/' . $about->img);
      }

      $about->update([
        'img' => $imageName
      ]);
    }
    return back();
  }

  public function storeImage($request)
  {
    $request->validate([
      'image' => 'required|image|max:2048',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->extension();
    Image::make($image)->save(public_path('/img') . '/' . $imageName);
    return $imageName;
  }
}
