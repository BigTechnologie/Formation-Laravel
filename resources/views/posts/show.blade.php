@extends('base')

@section('title')
    {{ $post->title }}
@endsection

@section('container')

    <div class="container">
        <h1>{{ $post->title }}</h1>
        <div class="posts row gx-0">
            <div class="post-img">
                <img src="{{ $post->imageUrl }}" height="200" alt="">
            </div>
            <strong>{{ $post->created_at->format("d-m-Y H:i:s") }}</strong>
            <div class="post-content text-justify">    
                {{ $post->content }}    
            </div>
        </div>

    </div>

@endsection