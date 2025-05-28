<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Post</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        @if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="200">
@endif

        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <div class="prose">
            {!! nl2br(e($post->content)) !!}
        </div>
        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">Back to Posts</a>
        </div>
    </div>
</body>
</html>
