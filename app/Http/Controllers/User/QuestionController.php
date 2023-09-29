<?php

namespace App\Http\Controllers\User;

use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\ReportAnswer;
use Illuminate\Http\Request;
use App\Models\QuestionTopic;
use App\Models\ReportComment;
use App\Models\ReportQuestion;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\UserTopic;
use Illuminate\Support\Facades\Cache;

class QuestionController extends Controller
{
  //function edit title 
  public function edit_title($title)
  {
    //remove space
    $removeSpace = str_replace(' ', '-', $title);
    //remove special char
    $removeChar = preg_replace('/[^A-Za-z0-9\-]/', '', $removeSpace);
    //add space
    $addSpace = str_replace('-', ' ', $removeChar);
    //make uppper case first letter title and add ? in last title
    return ucfirst($addSpace) . '?';
  }

  public function show(Question $question)
  {

    $reported_question = false;

    $user_id = auth()->id();
    $answered = Answer::where('question_id', $question->id)->where('user_id', $user_id)->first();
    $report_question = ReportQuestion::where('question_id', $question->id)->where('user_id', $user_id)->first();
    $topics = Topic::select(['id', 'name'])->get();

    $related_questions = null;

    if ($question->topics) {
      foreach ($question->topics as $topic) {
        $topic_id = $topic->id;
        $related_questions = Question::select(['title', 'title_slug'])->where('id', '!=', $question->id)->whereHas('topics', function ($query) use ($topic_id) {
          $query->where('topic_id', $topic_id);
        })->latest()->get();
      }
    }

    $report_comment_types = [
      [
        'name' => 'Pelecehan',
        'desc' => 'Melecehkan atau mengancam suatu individu'
      ],
      [
        'name' => 'Spam',
        'desc' => 'Menjual barang ilegal, penipuan uang, dll.'
      ]
    ];

    $report_answer_types = [
      [
        'name' => 'Pelecehan',
        'desc' => 'Melecehkan atau mengancam suatu individu'
      ],
      [
        'name' => 'Spam',
        'desc' => 'Menjual barang ilegal, penipuan uang, dll.'
      ],
      [
        'name' => 'Tidak menjawab pertanyaan',
        'desc' => 'Tidak menjawab pertanyaan yang ditanyakan'
      ],
      [
        'name' => 'Peniruan',
        'desc' => 'Menggunakan kembali konten tanpa atribusi'
      ],
      [
        'name' => 'Jawaban seperti lelucon',
        'desc' => 'Bukan jawaban yang tulus'
      ],
      [
        'name' => 'Penyesatan informasi yang berbahaya',
        'desc' => 'format, tata bahasa, dan ejaan yang sangat buruk'
      ],
      [
        'name' => 'Kredensial yang tidak pantas',
        'desc' => 'Kredensial penulis bersifat ofensif, spam, atau peniruan identitas'
      ],
      [
        'name' => 'Hoax',
        'desc' => 'Beberapa jenis informasi palsu atau menyesatkan yang bisa diverifikasi'
      ],
      [
        'name' => 'Konten dewasa',
        'desc' => 'Konten dengan unsur ketelanjangan/seksual'
      ]
    ];

    $report_question_types = [
      [
        'name' => 'Pelecehan',
        'desc' => 'Melecehkan atau mengancam suatu individu'
      ],
      [
        'name' => 'Spam',
        'desc' => 'Menjual barang ilegal, penipuan uang, dll.'
      ],
      [
        'name' => 'Jawaban seperti lelucon',
        'desc' => 'Bukan jawaban yang tulus'
      ],
      [
        'name' => 'Penyesatan informasi yang berbahaya',
        'desc' => 'format, tata bahasa, dan ejaan yang sangat buruk'
      ],
      [
        'name' => 'Topik salah',
        'desc' => 'Topik tidak relevan dengan konten atau terlalu luas'
      ]
    ];

    if ($report_question) {
      $reported_question = true;
    }

    views($question)
      ->cooldown(86400)
      ->record();

    $link = route('question.show', $question);

    return view('user.question.show', compact('question', 'answered', 'topics', 'reported_question', 'report_question_types', 'report_answer_types', 'report_comment_types', 'related_questions'));
  }

  public function store(Request $request)
  {

    $request->replace(['title' => $request->title . '?', 'topic_id' => $request->topic_id]);
    $user = auth()->user();

    $request->validate([
      'title' => 'required|min:10|unique:questions,title',
    ]);

    $title = $this->edit_title($request->title);

    $title_slug = Str::of($title)->slug('-');
    $counter = 0;
    while (Question::where('title_slug', '=', $title_slug)->count() > 0) {
      if ($counter == 0) {
        $title_slug = $title_slug . '-' . rand(0, 9);
        $counter++;
      } else {
        $title_slug = $title_slug . rand(0, 9);
      }
    }

    $question = $user->questions()->create([
      'title' => $title,
      'title_slug' => $title_slug,
    ]);

    if ($request->topic_id) {

      $count = 0;
      for ($i = 0; $i < count($request->topic_id); $i++) {
        $checkTopic = Topic::find($request->topic_id[$i]);
        $count++;
        //if added topics more than 8 or topic not found
        if ($count > 8 || $checkTopic == null) {
          break;
        }
        QuestionTopic::create([
          'question_id' => $question->id,
          'topic_id' => $request->topic_id[$i],
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        if (!Cache::has('topic_notification_' . $request->topic_id[$i] . auth()->user()->id)) {
          foreach (UserTopic::where('topic_id', '=', $request->topic_id[$i])->get() as $key) {
            $total = QuestionTopic::where('created_at', '>=', now()->subSeconds(86400))->where('topic_id', '=', $request->topic_id[$i])->count();
            Notifikasi::n_topic($key->user->id, $key->topic, $total);
          }
          Cache::put('topic_notification_' . $request->topic_id[$i] . auth()->user()->id, true, 86400);
        }
      }
    }

    foreach (auth()->user()->followers as $user) {
      Notifikasi::n_question($user->id, $question);
    }

    return redirect()->route('question.show', $title_slug)->with('message', ['text' => 'Pertanyaan berhasil ditambahkan!', 'class' => 'success']);
  }

  public function update(Question $question, Request $request)
  {

    if ($request->title) {

      $request->validate([
        'title' => 'required',
        'link' => 'url'
      ]);

      $user = auth()->user();

      $title = $this->edit_title($request->title);
      $title_slug = Str::of($title)->slug('-');

      $question->update([
        'title' => $title,
        'title_slug' => $title_slug,
      ]);
    }

    if ($request->topic_id) {

      $qtopics = QuestionTopic::where('question_id', $question->id)->get();

      foreach ($qtopics as $qtopic) {
        $qtopic->delete();
      }

      for ($i = 0; $i < count($request->topic_id); $i++) {
        QuestionTopic::create([
          'question_id' => $question->id,
          'topic_id' => $request->topic_id[$i],
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }

      $title_slug = Str::of($question->title)->slug('-');
    }

    return redirect()->route('question.show', $title_slug)->with('message', ['text' => 'Pertanyaan berhasil diperbarui dengan sukses!', 'class' => 'success']);
  }

  public function report(Request $request, Question $question)
  {

    $user_id = auth()->id();
    $report = ReportQuestion::where('user_id', $user_id)->where('question_id', $question->id)->first();

    if ($question->user_id == $user_id) {
      return back();
    }

    if ($report) {
      return back()->with('message', ['text' => 'Pertanyaan sudah dilaporkan sebelumnya!', 'class' => 'danger']);
    } else {
      ReportQuestion::create([
        'user_id' => $user_id,
        'question_id' => $question->id,
        'type' => $request->type,
      ]);

      return back()->with('message', ['text' => 'Pertanyaan berhasil dilaporkan!', 'class' => 'success']);
    }
  }

  public function destroy(Question $question)
  {

    $qtopics = QuestionTopic::where('question_id', $question->id)->get();
    $reports = ReportQuestion::where('question_id', $question->id)->get();

    foreach ($reports as $report) {
      $report->delete();
    }

    foreach ($qtopics as $qtopic) {
      $qtopic->delete();
    }

    foreach ($question->answers as $answer) {
      foreach ($answer->comments as $comment) {
        $comment->delete();
      }
      $answer->delete();
    }

    $question->delete();
    return redirect()->route('home')->with('message', ['text' => 'Pertanyaan berhasil dihapus dengan sukses!', 'class' => 'success']);
  }
}
