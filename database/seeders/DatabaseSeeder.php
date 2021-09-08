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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        Article::factory(15)->create();
        FeedbackMessage::factory(12)->create();
    }
}
