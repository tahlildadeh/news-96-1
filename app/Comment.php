<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Thlnews\Traits\Commentable;

class Comment extends Model
{
    use Commentable;


    protected $table = 'comments';

    protected $fillable = ['message', 'address'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
