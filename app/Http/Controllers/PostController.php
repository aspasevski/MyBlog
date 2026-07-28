<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('published', true)
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $validated['published'] = $request->boolean('published');

        // Засега го поврзуваме постот со корисникот со ID 1.
        // Подоцна, кога ќе направиме login, ќе користиме auth()->id().
        $validated['user_id'] = 1;

        $post = Post::create($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'The post was created successfully!');
    }

    public function show(Post $post)
    {
        $post->load([
            'user',
            'comments.user'
        ]);

        $post->loadCount('comments');

        return view('posts.show' , compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:200'],
            'body' => ['required', 'string', 'min:10'],
            'published' => ['nullable', 'boolean'],
        ]);

        $validated['published'] = $request->boolean('published');

        $post->update($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'The post was updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'The post was deleted successfully!');
    }
}
