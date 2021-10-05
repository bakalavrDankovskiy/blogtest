<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function articlesTagsCloud()
    {
        return (new static())->has('articles')->get();
    }

    public static function newsPostsTagsCloud()
    {
        return (new static())->has('newsPosts')->get();
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable')->with('tags');
    }

    public function newsPosts()
    {
        return $this->morphedByMany(NewsPost::class, 'taggable')->with('tags');
    }
}
