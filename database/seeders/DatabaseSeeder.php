<?php

namespace Database\Seeders;

use App\Models\FeedbackMessage;
use Illuminate\Database\Seeder;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        FeedbackMessage::factory(12)->create();
    }
}
