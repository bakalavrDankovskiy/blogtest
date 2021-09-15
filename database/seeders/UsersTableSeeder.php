<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();
        $data = [
            [
                'name' => 'User1',
                'email' => 'author@gmail.com',
                'role_id' => 2,
                'password' => bcrypt('user'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'User2',
                'email' => 'author2@gmail.com',
                'role_id' => 2,
                'password' => bcrypt('user'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'User3',
                'email' => 'author3@gmail.com',
                'role_id' => 2,
                'password' => bcrypt('user'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
