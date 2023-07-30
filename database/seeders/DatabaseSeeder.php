<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        //question
        \App\Models\Question::factory(15)->create();
        //topic
        \App\Models\Topic::factory(15)->create();
        //question_topic
        \App\Models\QuestionTopic::factory(15)->create();

        
    }
}