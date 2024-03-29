<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;

class NewsPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsPost::factory(50)->create();
    }
}
