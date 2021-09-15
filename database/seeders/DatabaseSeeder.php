<?php

namespace Database\Seeders;

use App\Models\FeedbackMessage;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TagArticleSeeder::class);
        FeedbackMessage::factory(10)->create();
    }
}
