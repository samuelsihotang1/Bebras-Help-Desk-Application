<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\ReportQuestion;
use App\Http\Controllers\Controller;
use App\Models\QuestionTopic;

class CheckQuestionController extends Controller
{
  public function index()
  {
    return view('admin.question.index', [
      'type' => 'all'
    ]);
  }

  public function reported()
  {
    return view('admin.question.index', [
      'type' => 'reported'
    ]);
  }

  public function update_status(Question $question, $status)
  {

    if ($status == 'deleted_by_admin') {

      $qtopics = QuestionTopic::where('question_id', $question->id)->get();
      $reports = ReportQuestion::where('question_id', $question->id)->get();

      foreach ($qtopics as $qtopic) {
        $qtopic->delete();
      }

      foreach ($question->answers as $answer) {
        $answer->delete();
      }

      foreach ($reports as $report) {
        $report->delete();
      }

      $question->delete();
    } else if ($status == 'viewed_by_admin') {

      $question->update([
        'status' => $status
      ]);
    } else {

      return back();
    }

    return back()->with('message', ['text' =>  'Status pertanyaan berhasil diperbarui dengan sukses!', 'class' => 'success']);
  }
}
