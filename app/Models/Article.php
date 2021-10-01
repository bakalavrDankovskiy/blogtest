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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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
}
