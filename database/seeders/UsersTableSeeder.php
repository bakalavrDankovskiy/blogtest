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
              'name' => 'Автор неизвестен',
              'email' => 'un_author@gmail.com',
              'password' => bcrypt(str_random(16)),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Автор',
                'email' => 'author@gmail.com',
                'password' => bcrypt(123123),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
