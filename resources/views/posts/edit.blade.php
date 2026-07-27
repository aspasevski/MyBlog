@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="card">
        <h1>Edit Post</h1>

        <p class="form-description">
            Update the title, contents or publication status of your post.
        </p>

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="@error('title') error @enderror"
                >

                @error('title')
                    <span class="error-msg">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Contents</label>

                <textarea
                    id="body"
                    name="body"
                    class="@error('body') error @enderror"
                >{{ old('body', $post->body) }}</textarea>

                @error('body')
                    <span class="error-msg">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="checkbox-group">
                <input
                    type="checkbox"
                    id="published"
                    name="published"
                    value="1"
                    @checked(old('published', $post->published))
                >

                <label for="published">
                    Published
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">
                    Update Post
                </button>

                <a href="{{ route('posts.show', $post) }}" class="secondary-button">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection