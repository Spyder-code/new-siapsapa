<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMedia>
 */
class PostMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = rand(0,1);
        return [
            'post_id' => rand(1,Post::count()),
            'type' => $type==0?'image':'video',
            'path' => $this->faker->imageUrl,
            'status' => 1
        ];
    }
}
