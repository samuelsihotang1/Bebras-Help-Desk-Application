<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifikasi extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public static function n_user($user)
  {
    DB::table('notifikasis')->insert([
      'user_id' => $user,
      'type' => 'user',
      'text' => auth()->user()->name . ' mengikuti anda',
      'slug_link' => auth()->user()->name_slug,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  } //done

  public static function n_question($user, $question)
  {
    DB::table('notifikasis')->insert([
      'user_id' => $user,
      'type' => 'question',
      'text' => auth()->user()->name . ' telah mengajukan sebuah pertanyaan "' . $question->title . '"',
      'slug_link' => $question->title_slug,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  } //done

  public static function n_answer($question)
  {
    DB::table('notifikasis')->insert([
      'user_id' => $question->user->id,
      'type' => 'answer',
      'text' => auth()->user()->name . ' menjawab pertanyaan anda "' . $question->title . '"',
      'slug_link' => $question->title_slug,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  } //done

  public static function n_topic($user, $topic, $total)
  {
    DB::table('notifikasis')->insert([
      'user_id' => $user,
      'type' => 'topic',
      'text' => 'Telah ada ' . $total . ' pertanyaan baru dengan topik "' . $topic->name . '"',
      'slug_link' => $topic->name_slug,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  } //done

  public static function n_comment($answer, $text)
  {
    DB::table('notifikasis')->insert([
      'user_id' => $answer->user->id,
      'type' => 'comment',
      'text' => auth()->user()->name . ' memberikan komentar pada jawaban anda "' . $text . '"',
      'slug_link' => $answer->question->title_slug,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  } //done
}
