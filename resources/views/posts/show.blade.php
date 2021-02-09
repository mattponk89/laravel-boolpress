@extends('layouts.app')

@section('content')

    <div class="container">
        <header class="text-center text-white">
            <h1 class="display-4 text-primary">Boolpress Posts</h1>
            <p class="btn btn-primary">
                <a href="{{route('posts.create')}}" class="text-white">
                    Create New Post
                </a>
            </p>
        </header>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">This Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">Back to posts</a>
                    </li>
                    @auth
                    @if ($post->author->id == $user->id)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.edit', $post) }}">Edit this Post</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete Post</button>
                        </form>
                    </li>
                    @endif
                    @endauth                   
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Author: {{$post->author->name}}</h6>
                <p class="card-text">{{ $post->info->description }}</p>
                <h6 class="card-subtitle mb-2 text-muted">Tags:</h6>
                    @foreach($post->tags as $tag)
                    <div class="bordertag">{{ $tag->title }}</div>
                    @endforeach

            </div>
        </div>
    </div>

@endsection