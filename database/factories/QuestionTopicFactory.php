<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionTopic>
 */
class QuestionTopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // DB::table('question_topics')->insert([
            //     'question_id' => 1,
            //     'topic_id' => 1,
            // ]);

            //buat seeder untuk question_topic dimana question_id dan topic_id random dari 1-15
            'question_id' => $this->faker->numberBetween(1, 15),
            'topic_id' => $this->faker->numberBetween(1, 15),

        ];
    }
    
}


