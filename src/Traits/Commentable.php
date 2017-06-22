<?php
/**
 * Created by PhpStorm.
 * User: Sadjad Tehranchi
 * Date: 22/06/2017
 * Time: 11:20 AM
 */

namespace Thlnews\Traits;


use App\Comment;
use App\User;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function submitComment($message, User $user=null)
    {
        //dd(__FILE__, static::class);

        $comment = new Comment(['message' => $message]);
        if($user){
            $comment->user()->associate($user);
        }

        if($this instanceof Comment){
           $comment->address = $this->address . $this->id . '-';
        }

        $this->comments()->save($comment);


        return $comment;
    }
}