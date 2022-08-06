<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\NewsPost;
use App\Models\User;
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
        $articleId = Article::get('id')->random()->id;
        $user_id = User::get('id')->random()->id;
        return [
            'txt' => $this->faker->realText(rand(100,500)),
            'user_id' => $user_id,
            'commentable_id' => $articleId,
            'commentable_type' => rand(0,1) == 1 ? Article::class : NewsPost::class,
        ];
    }
}
