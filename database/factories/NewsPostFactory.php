<?php

namespace Database\Factories;

use App\Models\NewsPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NewsPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8), true);
        $txt = $this->faker->realText(rand(1000, 4000));
        $excerpt = Str::limit($txt, 100);
        $createdAt = $this->faker->dateTimeBetween('-2 months',
            '-1 days');
        $is_published = rand(1, 10) > 3;

        $data = [
            'title' => $title,
            'txt' => $txt,
            'excerpt' => $excerpt,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
            'is_published' => $is_published,
        ];

        return $data;
    }
}
