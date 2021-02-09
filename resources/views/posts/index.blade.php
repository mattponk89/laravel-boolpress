@extends('layouts.app')

@section('content')

    <div class="container">
    <header class="text-center text-white">
        <h1 class="display-4 text-primary">Boolpress Posts</h1>
        <p class="btn btn-primary">
            <a href="{{ route('posts.create') }}" class="text-white">
                <u>Create New Post</u>
            </a>
        </p>
    </header>
    <div class="row">
        <div class="col-lg-12 mx-auto">
        <div class="card rounded shadow border-0">
            <div class="card-body p-5 bg-white rounded">
            <div class="table-responsive">
                <table id="example" style="width:100%" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Tags</th>
                    <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>

                        @auth
                            <td class="{{ $post->author->id == $user->id ? 'mypost' : '' }}">{{ $post->author->name }}</td>
                        @endauth

                        @guest
                            <td>{{ $post->author->name }}</td>
                        @endguest

                        <td>{{ $post->category->title }}</td>
                        <td>{{ $post->info->description }}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                {{ $tag->title }}
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <div>
                                <form action="{{ route('posts.show', $post )}}">
                                    <input class="btn btn-primary" type="submit" value="Show"/>
                                </form>
                            </div>
                            @auth
                            @if ($post->author->id == $user->id)
                            <div>
                                <form action="{{ route('posts.edit', $post )}}">
                                    <input class="btn btn-secondary" type="submit" value="Edit"/>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

@endsection