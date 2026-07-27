{{-- @extends('layouts.app')
@section('title', 'All Posts')
@section('content')
    <h1>Posts</h1>
    @forelse ($posts as $post)
        <article>
            <h2>
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
            </h2>
            <p>Authir:{{ $post->user->name }}</p>
            <p>{{ Str::limit($post->body, 150) }}</p>
            <small>{{ $post->created_at->diffForHumans() }}</small>
        </article>

    @empty
        <p>There arent any posrs</p>
    @endforelse
    {{ $posts->links() }}
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">My personal space</p>
            <h1>Latest Posts</h1>
        </div>

        <a href="{{ route('posts.create') }}" class="button">
            + Add New Post
        </a>
    </div>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="posts-grid">
        @forelse ($posts as $post)
            <article class="post-card">
                <div class="post-meta">
                    <span>By {{ $post->user->name }}</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>

                <h2>
                    <a href="{{ route('posts.show', $post) }}" class="post-title">
                        {{ $post->title }}
                    </a>
                </h2>

                <p class="post-preview">
                    {{ Str::limit($post->body, 140) }}
                </p>

                <a href="{{ route('posts.show', $post) }}" class="read-more">
                    Read more →
                </a>
            </article>
        @empty
            <div class="empty-state">
                <h2>No posts yet</h2>
                <p>Create your first blog post.</p>

                <a href="{{ route('posts.create') }}" class="button">
                    Create Post
                </a>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection