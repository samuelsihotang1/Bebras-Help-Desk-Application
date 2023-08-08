<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ReportComment;
use App\Http\Controllers\Controller;

class CheckCommentController extends Controller
{
  public function index()
  {
    return view('admin.comment.index', [
      'type' => 'all'
    ]);
  }

  public function reported()
  {
    return view('admin.comment.index', [
      'type' => 'reported'
    ]);
  }

  public function update_status(Comment $comment, $status)
  {

    if ($status == 'deleted_by_admin') {
      $reports = ReportComment::where('comment_id', $comment->id)->get();
      foreach ($reports as $report) {
        $report->delete();
      }
      $comment->delete();
    } else if ($status == 'viewed_by_admin') {
      $comment->update([
        'status' => $status
      ]);
    } else {
      return back();
    }

    return back()->with('message', ['text' =>  'Comment status updated successfully!', 'class' => 'success']);
  }
}
