<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('role_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table
                ->foreign('role_id')
                ->references('id')
                ->on('roles');
        });

        /**
         * Создание админа при миграции
         */
        $admin = [
            'name' => 'Admin',
            'email' => config('app.admin_email'),
            'role_id' => 1,
            'password' => bcrypt(config('app.admin_password')),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        DB::table('users')->insert($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
