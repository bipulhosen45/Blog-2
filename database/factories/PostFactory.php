<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => random_int(13, 17),
            'sub_category_id' => random_int(3, 4),
            'description' => $this->faker->paragraph(),
            'post_title' => $this->faker->sentence(),
            'user_id' => random_int(1, 2),
            'slug' => $this->faker->slug(),
            'is_approved' => 1,
            'image' => $this->faker->imageUrl(1000, 600, 'dogs'),
        ];
    }
}
