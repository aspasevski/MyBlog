@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <div class="card">

        <h1>Create a New Post</h1>

        <p class="form-description">
            Write a new article and publish it to your blog.
        </p>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>

                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    placeholder="Enter the post title" class="@error('title') error @enderror">
                <x-form-error field="title" />
            </div>

            <div class="form-group">
                <label for="body">Contents</label>

                <textarea id="body" name="body" placeholder="Write your post here..." class="@error('body') error @enderror">{{ old('body') }}</textarea>

                <x-form-error field="body" />
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="published" name="published" value="1" @checked(old('published'))>

                <label for="published">
                    Published
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="button">
                    Save Post
                </button>

                <a href="{{ route('posts.index') }}" class="secondary-button">
                    Cancel
                </a>
            </div>

        </form>

    </div>

@endsection
