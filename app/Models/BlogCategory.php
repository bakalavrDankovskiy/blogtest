<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable
        = [
          'title',
          'slug',
          'parent_id',
          'description',
        ];

    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory()->title
            ?? ($this->isRoot()
            ? 'Корень'
                : '???'
            );
    }

    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
}
