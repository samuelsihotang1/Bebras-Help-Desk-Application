<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CheckUserController extends Controller
{
  public function index()
  {
    return view('admin.user.index', [
      'type' => 'all'
    ]);
  }

  public function unapproved()
  {
    return view('admin.user.index', [
      'type' => 'unapproved'
    ]);
  }

  public function update_status(User $user, $status)
  {

    if ($status == 'deleted_by_admin') {
      $user->delete();
      return back()->with('message', ['text' =>  'Pengguna berhasil dihapus!', 'class' => 'success']);
    } elseif ($status == 'approved') {
      $user->update([
        'approved' => 'true',
      ]);
      return back()->with('message', ['text' =>  'Pengguna berhasil disetujui!', 'class' => 'success']);
    }
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'marker' => ['required'],
    ]);

    if ($request['marker'] == 'guru') {
      $role = 'user';
    } else {
      $role = 'admin';
    }

    $name_slug = Str::of($request['name'])->slug('-');
    $avatar = 'https://ui-avatars.com/api/?name=' . $request['name'] . '&background=868e96&color=fff';

    User::create([
      'name' => $request['name'],
      'name_slug' => $name_slug,
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'avatar' => $avatar,
      'marker' => $request['marker'],
      'role' => $role,
      'approved' => 'true',
    ]);

    return back()->with('message', ['text' =>  'Pengguna berhasil dibuat!', 'class' => 'success']);
  }

  public function update(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'marker' => ['required'],
    ]);

    if ($request['marker'] == 'guru') {
      $role = 'user';
    } else {
      $role = 'admin';
    }

    User::where('id', $request['user_id'])->update([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'marker' => $request['marker'],
      'role' => $role,
    ]);

    return back()->with('message', ['text' =>  'Pengguna berhasil diperbarui!', 'class' => 'success']);
  }
}
