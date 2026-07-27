@extends('layouts.app')

@section('title', $post->title)

@section('content')
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <article class="card">
        <div class="post-meta">
            <span>
                By {{ $post->user->name }}
            </span>

            <span>
                {{ $post->created_at->format('d.m.Y H:i') }}
            </span>
        </div>

        <h1 class="single-post-title">
            {{ $post->title }}
        </h1>

        <div class="post-content">
            {{ $post->body }}
        </div>

        <div class="post-actions">
            <a href="{{ route('posts.index') }}" class="secondary-button">
                ← Back to Posts
            </a>

            <a href="{{ route('posts.edit', $post) }}" class="button action-link">
                Edit Post
            </a>

            <form
                action="{{ route('posts.destroy', $post) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this post?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-button">
                    Delete Post
                </button>
            </form>
        </div>
    </article>
@endsection