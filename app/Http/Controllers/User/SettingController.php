<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
  public function index()
  {
    return view('user.setting.index');
  }

  public function update_password(Request $request, User $user)
  {

    if ($user->id != auth()->id()) {
      return back();
    }

    $request->validate([
      'password' => 'required|string|min:8'
    ]);

    $user->update([
      'password' => Hash::make($request->password)
    ]);

    return back()->with('message', ['text' =>  'Kata sandi profil berhasil diperbarui dengan sukses!', 'class' => 'success']);
  }

  public function update_phone(Request $request, User $user)
  {
    if ($user->id != auth()->id()) {
      return back();
    }

    $request->validate([
      'phone_number' => [
        'required',
        'string',
        'min:8',
        'regex:/^628\d+$/',
      ],
    ]);

    $user->update([
      'phone_number' => $request->phone_number
    ]);

    return back()->with('message', ['text' => 'Nomor HP berhasil diperbarui dengan sukses!', 'class' => 'success']);
  }
}
