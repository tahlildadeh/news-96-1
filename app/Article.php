<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Thlnews\Traits\Commentable;

class Article extends Model
{
    use Commentable;
    protected $table = 'articles';

    protected $fillable = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }


    public function scopeVisible($builder)
    {
        return $builder->where('approved', true)->where(function($query){
            return $query->orWhereNull('published_at')
                ->orWhere('published_at', '<=', Carbon::now());
        })->where('active', true);
    }

}
