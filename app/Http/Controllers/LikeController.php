<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    // app/Http/Controllers/LikeController.php
public function toggle(Request $request, Post $post)
{

    $like = $post->likes()->where('user_id', auth()->id())->first();

    if ($like) {
        $like->delete();
    } else {
        $post->likes()->create(['user_id' => auth()->id()]);
    }

    return response()->json([
        'liked' => !$like,
        'likes_count' => $post->likes()->count()
    ]);
}

}
