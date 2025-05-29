<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
{
    $request->validate([
        'body' => 'required|string|max:1000'
    ]);

    $comment = $post->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->body
    ]);

    return response()->json([
        'comment' => $comment->load('user'),
        'comments_count' => $post->comments()->count()
    ]);
}

}
