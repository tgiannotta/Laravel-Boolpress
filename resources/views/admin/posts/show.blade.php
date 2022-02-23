@extends('layouts.dashboard')

@section('content')
    <section>
        <div class="container">
            <h1>{{$post->title}}</h1>
            <div class="mb-2">Slug: {{ $post->slug }}</div>
            <p>{{ $post->content }}}</p>

            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica Post</a>
        </div>
    </section>
@endsection