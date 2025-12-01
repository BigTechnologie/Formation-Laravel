@extends('base')

@section('title')
    Laravel Home Page
@endsection

@section('container')

    <div class="container">
        <h1> {{ $title }} </h1>

        {!! $description !!}
       {{--  @dump($title) --}}
       <div class="posts row border">
            @foreach ($posts as $post)
                {{-- @dump($post) --}}
                @if ($post['id'] % 2 == 0)
                    <div class="post-item col-md-3 card pair">
                        <img src="{{ $post['imageUrl'] }}" alt="s">
                        <h4> {{ $post['title'] }} </h4>
                        <p> {{ $post['description'] }} </p>
                    </div>
                @else
                    <div class="post-item col-md-3 card impair">
                        <img src="{{ $post['imageUrl'] }}" alt="s">
                        <h4> {{ $post['title'] }} </h4>
                        <p> {{ $post['description'] }} </p>
                    </div>
                @endif
            @endforeach
       </div>

    </div>

@endsection