<?php

namespace App\Models;

use App\Enums\Roles;
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function role()
    {
        return $this->BelongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name == Roles::ADMIN;
    }

    public function isNotAdmin()
    {
        return $this->role->name !== Roles::ADMIN;
    }

    public static function admin()
    {
        return User::where('email', '=', config('app.admin_email'))
            ->first();
    }

    public function scopeActive($builder)
    {
        return $builder->has('articles');
    }

    public function scopeWithMostArticles($builder)
    {
        return $builder->withCount('articles')->orderByDesc('articles_count')->get('name','id')->first();
    }

    public function scopeAverageCountOfArticlesUsersHave($builder)
    {
        return $builder->active()->withCount('articles')->get()->avg('articles_count');
    }
}
