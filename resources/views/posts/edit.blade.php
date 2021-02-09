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
                        <a class="nav-link active" href="#">Edit Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">Back to posts</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <form action="{{ route('posts.update', $post) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" value="{{ $post->title }}" type="text">
                </div>               
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
               
                        @foreach ($categories as $category)             
                            <option value="{{ $category->id }}" {{ $post->category->id == $category->id ? 'selected' : '' }}>
                                {{$category->title}}
                            </option>     
                        @endforeach
                    </select>
                    <label>Content</label>
                    <textarea name="content" class="form-control" type="text" >{{ $post->info->description }}</textarea>
                        @foreach($tags as $tag)
                        <div class="bordertag">
                            <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                            <label for="tags[]">{{ $tag->title }}</label>
                        </div>
                        @endforeach
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Edit"/>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection