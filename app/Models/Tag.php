<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'name',
        ];

    public static function tagsCloud()
    {
        return (new static())->has('articles')->get();
    }

    public function articles()
    {
        return $this->BelongsToMany(Article::class, 'tag_article');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
