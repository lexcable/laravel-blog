@extends('layout')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li class="mb-6 border-b pb-4">
                @if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="200">
@endif

                <a href="{{ route('posts.show', $post->id) }}" class="text-xl font-bold text-blue-600 hover:underline">{{ $post->title }}</a>
                <p class="mt-1">{{ $post->content }}</p>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
