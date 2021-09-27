<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8), true);
        $ownerId = rand(1,4);
        $slug = Str::slug($title);
        $txt = $this->faker->realText(rand(1000, 4000));
        $excerpt = Str::limit($txt, 100);
        $createdAt = $this->faker->dateTimeBetween('-2 months',
            '-1 days');
        $is_published = rand(1, 10) > 3;

        $data = [
            'owner_id' => $ownerId,
            'title' => $title,
            'slug' => $slug,
            'txt' => $txt,
            'excerpt' => $excerpt,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
            'is_published' => $is_published,
        ];

        return $data;
    }
}
