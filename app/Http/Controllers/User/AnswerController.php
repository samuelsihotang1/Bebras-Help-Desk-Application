<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use App\Models\ReportAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AnswerController extends Controller
{
  public function storeImage($request)
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $image = $request->file('image');
    $imageName = time() . '.' . $image->extension();
    Image::make($image)->save(public_path('/img') . '/' . $imageName);
    return $imageName;
  }

  public function index()
  {
    return view('user.answer.index');
  }

  public function store(Request $request, Question $question)
  {
    $answer = Answer::where('question_id', $question->id)->where('user_id', auth()->id())->first();
    $imageName = null;

    if ($answer) {
      return back()->with('message', ['text' => 'You already answer the question!', 'class' => 'danger']);
    }

    $request->validate([
      'text' => 'required',
      'image' => 'image|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $imageName = $this->storeImage($request);
    }

    Answer::create([
      'user_id' => auth()->id(),
      'question_id' => $question->id,
      'text' => $request->text,
      'image' => $imageName,
    ]);

    return redirect()->route('question.show', $question->title_slug)->with('message', ['text' => 'Answer added successfully!', 'class' => 'success']);
  }

  //vote
  public function vote(Answer $answer, $vote)
  {

    $authUser = auth()->user();

    if ($vote == "upvote") {
      if ($authUser->hasUpVoted($answer)) {
        $authUser->cancelVote($answer);
      } else {
        $authUser->upVote($answer);
      }
    } else if ($vote == "downvote") {
      if ($authUser->hasDownVoted($answer)) {
        $authUser->cancelVote($answer);
      } else {
        $authUser->downVote($answer);
      }
    }

    return back();
  }

  public function report(Request $request, Answer $answer)
  {

    $user_id = auth()->id();
    $report = ReportAnswer::where('user_id', $user_id)->where('answer_id', $answer->id)->first();

    if ($answer->user_id == $user_id) {
      return back();
    }

    if ($report) {
      return back()->with('message', ['text' => 'Answer already reported!', 'class' => 'danger']);
    } else {

      ReportAnswer::create([
        'user_id' => $user_id,
        'answer_id' => $answer->id,
        'type' => $request->type,
      ]);

      return back()->with('message', ['text' => 'Answer reported successfully!', 'class' => 'success']);
    }
  }

  public function update(Answer $answer, Request $request)
  {

    $request->validate([
      'text' => 'required',
      'image' => 'image|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $imageName = $this->storeImage($request);
      if ($answer->image) {
        File::delete('img/' . $answer->image);
      }
    } else {
      $imageName = $answer->image;
    }

    $answer->update([
      'text' => $request->text,
      'image' => $imageName
    ]);

    return back()->with('message', ['text' => 'Answer updated successfully!', 'class' => 'success']);
  }

  public function destroy(Answer $answer)
  {
    $reports = ReportAnswer::where('answer_id', $answer->id)->get();

    if ($answer->question->pin_answer == $answer->id) {
      $answer->question->update([
        'pin_answer' => null
      ]);
    }

    if ($answer->image) {
      File::delete('img/' . $answer->image);
    }

    foreach ($reports as $report) {
      $report->delete();
    }

    foreach ($answer->comments as $comment) {
      $comment->delete();
    }

    $answer->delete();

    return back()->with('message', ['text' => 'Answer deleted successfully!', 'class' => 'success']);
  }

  public function pin(Answer $answer)
  {
    $question = $answer->question;

    $question->update([
      'pin_answer' => $answer->id
    ]);

    return back()->with('message', ['text' => 'Answer pinned successfully!', 'class' => 'success']);
  }

  public function deletepin(Answer $answer)
  {
    $question = $answer->question;

    $question->update([
      'pin_answer' => null
    ]);

    return back()->with('message', ['text' => 'Answer pinned successfully!', 'class' => 'success']);
  }
}
