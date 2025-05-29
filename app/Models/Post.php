<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];
    public function likes()
{
    return $this->hasMany(Like::class);
}

public function isLikedBy($user)
{
    if (!$user) return false;
    return $this->likes->where('user_id', $user->id)->count() > 0;
}
public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}

}
