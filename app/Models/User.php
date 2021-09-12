<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id');
    }

    public function role()
    {
        return $this
            ->BelongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name == 'admin';
    }

    public function isNotAdmin()
    {
        return $this->role->name !== 'admin';
    }

    /*
     * Временное решение! Возвращает админа
     */
    public static function admin()
    {
        return User::where('email', '=', config('app.admin_email'))
            ->first();
    }
}
