<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //user_id random 1-10
            'user_id' => $this->faker->numberBetween(1,10),
            'title' => $this->faker->sentence(6),
            'title_slug' => $this->faker->slug(),        
        ];
    }
}