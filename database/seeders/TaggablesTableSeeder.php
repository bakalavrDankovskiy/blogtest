<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\NewsPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TaggablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();
        $articles = Article::all();
        $newsPosts = NewsPost::all();

        foreach ($articles as $article) {
                $article->tags()->sync($tags->random(5)->pluck('id'));
        }

        foreach ($newsPosts as $newsPost) {
            foreach ($tags->random(5) as $tag) {
                $newsPost->tags()->sync($tags->random(5)->pluck('id'));
            }
        }
    }
}
