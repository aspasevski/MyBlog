<article class="card post-card">
    <div class="post-meta">
        <span>
            By
            <a href="{{ route('users.posts', $post->user) }}">
                {{ $post->user->name }}
            </a> </span>



        <span>
            {{ $post->created_at->format('d.m.Y H:i') }}
        </span>
    </div>
    <h2>
        <a href="{{ route('posts.show', $post) }}" class="post-title">
            {{ $post->title }}
        </a>
    </h2>



    <div class="post-content">
        {{ \Illuminate\Support\Str::limit($post->body, 150) }}
    </div>


    <a href="{{ route('posts.show', $post) }}" class="button action-link">
        Read More</a>
</article>
