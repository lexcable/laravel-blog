@extends('layout')

@section('content')
<div class="container mx-auto mt-4">
    <ul>
        @foreach ($posts as $post)
        <li class="mb-6 border-b pb-4">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="200">
            @endif

            <a href="{{ route('posts.show', $post->id) }}" class="text-xl font-bold text-blue-600 hover:underline">
                {{ $post->title }}
            </a>

            <p class="mt-1">{{ $post->content }}</p>

            <div
                x-data="{
                    liked: {{ json_encode($post->isLikedBy(auth()->user())) }},
                    likes: {{ $post->likes->count() }},
                    comments: {{ $post->comments->count() }},
                    newComment: '',
                    commentList: {{ $post->comments->load('user')->toJson() }},
                    toggleLike() {
                        fetch('{{ route('posts.like', $post) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.liked = data.liked;
                            this.likes = data.likes_count;
                        });
                    },
                    submitComment() {
                        fetch('{{ route('posts.comment', $post) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ body: this.newComment })
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.commentList.unshift(data.comment);
                            this.comments = data.comments_count;
                            this.newComment = '';
                        });
                    }
                }"
                class="p-4 border rounded mb-4"
            >
                <div class="flex items-center space-x-4 mt-2">
                    <button @click="toggleLike()" class="text-red-500">
                        <span x-show="liked">❤️</span>
                        <span x-show="!liked">🤍</span>
                        <span x-text="likes"></span>
                    </button>

                    <span>💬 <span x-text="comments"></span></span>
                </div>

                <form @submit.prevent="submitComment()" class="mt-2">
                    <input type="text" x-model="newComment" class="border p-1 w-full" placeholder="Add a comment...">
                    <button type="submit" class="mt-2 text-blue-600">Post</button>
                </form>

                <ul class="mt-2 text-sm text-gray-700">
                    <template x-for="comment in commentList" :key="comment.id">
                        <li><strong x-text="comment.user.name"></strong>: <span x-text="comment.body"></span></li>
                    </template>
                </ul>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
