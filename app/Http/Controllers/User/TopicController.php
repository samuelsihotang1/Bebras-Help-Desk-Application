<?php

namespace App\Http\Controllers\User;

use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserTopic;

class TopicController extends Controller
{
  public function store(Request $request)
  {

    $request->validate([
      'topic_name' => 'required|alpha|unique:topics,name|max:20|min:3'
    ]);

    $topic_name = strtolower($request->topic_name);
    $name = ucfirst($topic_name);

    Topic::create([
      'name' => $name,
      'name_slug' => Str::of($name)->slug('-')
    ]);

    return back()->with('message', ['text' => 'Topik berhasil ditambahkan', 'class' => 'sukses']);
  }

  public function show(Topic $topic)
  {
    $status = UserTopic::where('user_id', auth()->id())->where('topic_id', $topic->id)->first() ? 'Mengikuti' : 'Ikuti';
    $topic_id = $topic->id;
    $answers = Answer::whereHas('question', function ($query) use ($topic_id) {
      $query->whereHas('topics', function ($q) use ($topic_id) {
        $q->where('topic_id', $topic_id);
      });
    })->where('user_id', '!=', auth()->user()->id)->latest()->get();

    return view('user.topic.show', compact('answers', 'topic', 'status'));
  }
}
