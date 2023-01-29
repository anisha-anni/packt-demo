<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){
        //these values are temporary and currently not in use as we are getting value from API given in doc.
        return [
            'title' => fake()->name(),
            'author' => fake()->name(),
            'genre' =>fake()->name(),
            'description' =>fake()->paragraph(),
            'isbn' => fake()->name(),
            'image' => fake()->image(),
            'published' => '2023-01-26',
            'publisher' => fake()->company()
        ];
    }
}