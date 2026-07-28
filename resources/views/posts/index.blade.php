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
        <x-alert :message="session('success')" />
    @endif

    <div class="posts-grid">
        @forelse ($posts as $post)
            <x-post-card :post="$post" />
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