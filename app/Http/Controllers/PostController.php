<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->published()
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

        $post = auth()->user()->posts()->create($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'The post was created successfully!');
    }

    public function show(Post $post)
    {
        if (! $post->published && auth()->id() !== $post->user_id) {
            abort(404);
        }

        $post->load([
            'user',
            'comments.user',
        ]);

        $post->loadCount('comments');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->ensureOwner($post);

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $validated['published'] = $request->boolean('published');

        $post->update($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'The post was updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->ensureOwner($post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'The post was deleted successfully!');
    }

    public function byUser(User $user)
    {
        $posts = $user->posts()
            ->with('user')
            ->withCount('comments')
            ->published()
            ->latest()
            ->paginate(10);

        return view('posts.user', compact('user', 'posts'));
    }

    private function ensureOwner(Post $post): void
    {
        abort_unless(
            auth()->check() && auth()->id() === $post->user_id,
            403,
            'You are not allowed to modify this post.'
        );
    }
}