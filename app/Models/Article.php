<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'owner_id',
            'title',
            'slug',
            'txt',
            'excerpt',
            'is_published',
        ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope('withComments', function (Builder $builder) {
            return $builder->with('comments', function ($builder) {
                return $builder->orderByDesc('created_at');
            })->with('history');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function history()
    {
        return $this
            ->belongsToMany(User::class, 'article_histories')
            ->withTimestamps();
    }

    public function articleChanges()
    {
        return $this->hasMany(ArticleHistory::class);
    }

    public function scopeOnlyPublished($builder)
    {
        return $builder->where('is_published', 1);
    }

    public function scopeGetOnlyOwned($builder)
    {
        return $builder->where('owner_id', auth()->user()->id)->get();
    }

    public function scopeShortest($builder)
    {
        return $builder->where('txt', \DB::table('articles')->min('txt'))->first();
    }

    public function scopeLongest($builder)
    {
        return $builder->where('txt', \DB::table('articles')->max('txt'))->first();
    }

    public function scopeMostUpdated($builder)
    {
        return $builder->withCount('history')->orderByDesc('history_count')->first();
    }

    public function scopeMostCommented($builder)
    {
        return $builder->withCount('comments')->orderByDesc('comments_count')->first();
    }
}
