<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Web Programming',
            'Studying',
            'Fine Art',
            'Actor',
            'Anime',
            'Fitness',
            'Clothing',
            'Movies',
            'Writers',
            'Author',
            'Books',
            'Science',
            'Biology',
            'Brands',
            'Branding',
            'Cameras',
            'Computer',
            'Cards',
            'Motorcycle',
            'Engines',
            'Web',
            'Digital',
            'Marketing',
            'Music',
            'Pets',
            'Medical',
            'Dreams',
            'Recipes',
            'Experiences',
            'English',
            'Literature',
            'Facts',
            'Food',
            'Data Science'
        ]);
    
        return [
            'name' => $name,
            'name_slug' => \Illuminate\Support\Str::slug($name),
        ];
    }
    
}