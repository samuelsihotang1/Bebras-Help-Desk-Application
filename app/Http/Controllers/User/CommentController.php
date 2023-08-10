<?php

namespace App\Http\Controllers\User;

use App\Models\Answer;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ReportComment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $comment = new Comment;
    $comment->comment = $request->comment;
    $comment->user()->associate($request->user());

    $answer = Answer::find($request->answer_id);
    $answer->comments()->save($comment);

    return back()->with('message', ['text' => 'Komentar berhasil ditambahkan!', 'class' => 'success']);
  }

  public function update(Request $request, Comment $comment)
  {

    $comment->update([
      'comment' => $request->comment
    ]);

    return back()->with('message', ['text' => 'Komentar berhasil diperbarui!', 'class' => 'success']);
  }

  public function destroy(Comment $comment)
  {

    $reports = ReportComment::where('comment_id', $comment->id)->get();

    foreach ($reports as $report) {
      $report->delete();
    }

    $comment->delete();

    return back()->with('message', ['text' => 'Komentar berhasil dihapus!', 'class' => 'success']);
  }

  public function report(Request $request, Comment $comment)
  {
    $user_id = auth()->id();
    $report = ReportComment::where('user_id', $user_id)->where('comment_id', $comment->id)->first();

    if ($comment->user_id == $user_id) {
      return back();
    }

    if ($request->type != NULL) {
      ReportComment::create([
        'user_id' => $user_id,
        'comment_id' => $comment->id,
        'type' => $request->type,
      ]);
      return back()->with('message', ['text' => 'Komentar berhasil dilaporkan!', 'class' => 'success']);
    }
    return back()->with('message', ['text' => 'Tolong laporkan dengan benar', 'class' => 'danger']);
  }
}
