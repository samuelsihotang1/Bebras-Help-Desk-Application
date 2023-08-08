<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\ReportAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckAnswerController extends Controller
{
  public function index()
  {
    return view('admin.answer.index', [
      'type' => 'all'
    ]);
  }

  public function reported()
  {
    return view('admin.answer.index', [
      'type' => 'reported'
    ]);
  }

  public function update_status(Answer $answer, $status)
  {

    if ($status == 'deleted_by_admin') {

      $reports = ReportAnswer::where('answer_id', $answer->id)->get();

      foreach ($reports as $report) {
        $report->delete();
      }

      foreach ($answer->comments as $comment) {
        $comment->delete();
      }

      $answer->delete();
    } else if ($status == 'viewed_by_admin') {

      $answer->update([
        'status' => $status
      ]);
    } else {

      return back();
    }

    return back()->with('message', ['text' =>  'Answer status updated successfully!', 'class' => 'success']);
  }
}
