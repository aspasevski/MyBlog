<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => [
                'required',
                'string',
                'min:3',
                'max:1000'
            ]
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body']
        ]);


        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }
}
