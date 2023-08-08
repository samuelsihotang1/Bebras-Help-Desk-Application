<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckUserController extends Controller
{
  public function index()
  {
    return view('admin.user.index', [
      'type' => 'all'
    ]);
  }

  public function update_status(User $user, $status)
  {

    if ($status == 'deleted_by_admin') {
      $user->delete();
    } else {
      return back();
    }

    return back()->with('message', ['text' =>  'User status updated successfully!', 'class' => 'success']);
  }
}
