<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagArticleSeeder extends Seeder
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
        $data = [];

        foreach ($articles as $article) {
            foreach ($tags->random(5) as $tag) {
                $data[] = [
                    'article_id' => $article->id,
                    'tag_id' => $tag->id,
                ];
            }
        }
        \DB::table('tag_article')->insert($data);
    }
}
