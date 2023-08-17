<?php

namespace Database\Seeders;

use App\Models\about;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(20)->create();
    // //question
    // \App\Models\Question::factory(15)->create();
    // //topic
    // \App\Models\Topic::factory(15)->create();
    // //question_topic
    // \App\Models\QuestionTopic::factory(15)->create();
    DB::table('abouts')->insert([
      'title' => 'Tentang kami',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse gravida dui id ultricies bibendum. Maecenas elit nisl, varius volutpat interdum viverra, euismod eget augue. Nam ante odio, viverra ac risus a, bibendum euismod tortor. Etiam imperdiet ullamcorper lacus, at sagittis lorem facilisis sagittis. Praesent sed enim sed risus efficitur facilisis in at elit. Curabitur ac turpis vestibulum, rutrum lorem eu, bibendum sem. Etiam semper vel dolor et laoreet. Curabitur velit sem, faucibus id molestie quis, efficitur nec justo. ',
      'img' => 'about.jpg',
    ]);
  }
}
