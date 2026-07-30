<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->validated('body'),
        ]);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }
}