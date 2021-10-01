<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'title',
            'txt',
            'excerpt',
            'is_published',
        ];

    public function scopeOnlyPublished($builder)
    {
        return $builder->where('is_published', 1);
    }
}
