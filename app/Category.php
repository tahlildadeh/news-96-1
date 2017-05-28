<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $appends = [
        'slug'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function superCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public function getSlugAttribute()
    {
        return 'slug_' . $this->id;
    }
}
