@extends('layout')

@section('content')
<h1>Create Post </h1>
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Post Title"><br>
    <textarea name="content" placeholder="Post Content"></textarea><br>

    <input type="file" name="image"><br>

    <button type="submit">Submit</button>
</form>
