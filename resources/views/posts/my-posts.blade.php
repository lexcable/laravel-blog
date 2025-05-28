@extends('layout')

@section('content')
    <h1>My Posts</h1>
    <ul>
        @foreach ($posts as $post)
            <li class="mb-6 border-b pb-4">
                @if ($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="max-w-full h-auto rounded">
                    </div>
                @endif
                <a href="{{ route('posts.show', $post->id) }}" class="text-xl font-bold text-blue-600 hover:underline">{{ $post->title }}</a>
                <p class="mt-1">{{ $post->content }}</p>
                <div class="mt-2">
                    <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display:inline;">
                        <button type="submit" class="btn btn-secondary">Edit</button>
                    </form>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
