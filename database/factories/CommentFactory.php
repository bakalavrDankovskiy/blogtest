<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $articlesIds = Article::all()->pluck('id');
        return [
            'user_id' => rand(1,3),
            'article_id' => $articlesIds->random(),
            'txt' => $this->faker->realText(rand(100,500)),
        ];
    }
}
