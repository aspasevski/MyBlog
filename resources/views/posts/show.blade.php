@extends('layouts.app')

@section('title', $post->title)

@section('content')
    @if (session('success'))
        <x-alert :message="session('success')" />
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

            <small>
                ({{ $post->comments_count }}
                {{ $post->comments_count === 1 ? 'comment' : 'comments' }})
            </small>
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

            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this post?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-button">
                    Delete Post
                </button>
            </form>
        </div>
    </article>

    <section class="card comments-section">
        <h2>Add a comment</h2>

        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="comment-form">
                @csrf

                <div class="form-group">
                    <label for="body">
                        Your comment
                    </label>

                    <textarea id="body" name="body" rows="4" class="@error('body') input-error @enderror"
                        placeholder="Write your comment here...">{{ old('body') }}</textarea>

                    @error('body')
                        <div class="validation-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="button">
                    Add Comment
                </button>
            </form>
        @else
            <p>
                You must
                <a href="{{ route('login') }}">
                    log in
                </a>
                to leave a comment.
            </p>
        @endauth
    </section>

    <section class="card comments-section">
        <h2>
            Comments ({{ $post->comments_count }})
        </h2>

        @forelse ($post->comments as $comment)
            <article class="comment">
                <div class="comment-header">
                    <strong>
                        {{ $comment->user->name }}
                    </strong>

                    <span>
                        {{ $comment->created_at->format('d.m.Y H:i') }}
                    </span>
                </div>

                <p class="comment-body">
                    {{ $comment->body }}
                </p>
            </article>
        @empty
            <p>
                There are no comments yet. Be the first to comment!
            </p>
        @endforelse
    </section>
@endsection
