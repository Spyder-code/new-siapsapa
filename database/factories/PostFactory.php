<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            'post_category_id' => rand(1,9),
            'title' => $this->faker->sentence(3),
            'cover_image' => $this->faker->imageUrl,
            'content' => $this->faker->realText,
            'user_created' => 1,
            'admin_validated' => 1,
            'status' => rand(0,1)
        ];
    }
}
