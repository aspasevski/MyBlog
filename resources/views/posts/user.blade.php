@extends('layouts.app')

@section('title', $user->name . ' - Posts')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Author</p>
            <h1>{{ $user->name }}'s Posts</h1>
        </div>

        <a href="{{ route('posts.index') }}" class="secondary-button">
            ← All Posts
        </a>
    </div>

    <div class="posts-grid">
        @forelse ($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <div class="empty-state">
                <h2>No published posts</h2>
                <p>This user has not published any posts yet.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection