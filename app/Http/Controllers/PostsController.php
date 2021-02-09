<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\PostInfo;
use App\Tag;
use App\Post;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $user = Auth::user();
        return view('posts.index', compact('posts', 'tags', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $tags = Tag::all();
            $categories = Category::all();
            $user = Auth::user();

            return view('posts.create', compact('tags', 'categories', 'user'));
        }
        return redirect()->route('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $data = $request->all();
            $user = Auth::user();
            $newPost = new Post;
    
            $newPost->title = $data['title'];
            $newPost->user_id = $user->id;
            $newPost->category_id = $data['category_id'];
    
            $newPost->save();
    
            $newPostInfo = new PostInfo;
            $newPostInfo->post_id = $newPost->id;
            $newPostInfo->slug = Str::slug($newPost->title);
            $newPostInfo->description = $data['content'];
    
            $newPostInfo->save();
    
            $newPost->tags()->attach($data['tags']);
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = Auth::user();
        return view('posts.show', compact('post', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::check()){
            if($post->author->id == Auth::user()->id){
                $categories = Category::all();
                $tags = Tag::all();
                return view('posts.edit', compact('post', 'categories', 'tags'));
            }
        }
        return redirect()->route('posts.index');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(Auth::check()){
            $user = Auth::user();
            if ($post->author->id == Auth::user()->id){
                $data = $request->all();
        
                $post->update([
                    'title' => $data['title'],
                    'user_id' => $user->id,
                    'category_id' => $data['category_id']
                ]);
        
                $post->info()->update(['description' => $data['content']]);
        
                $post->tags()->sync($data['tags']);
        
                return redirect()->route('posts.show', $post);
            }
        } 
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Auth::check()){
            $user = Auth::user();
            if ($post->author->id == Auth::user()->id){
                $post->info()->delete();
                $post->tags()->detach();
                $post->delete();
        
                return redirect()->route('posts.index');
            }
        }
        return redirect()->route('posts.index');
    }
}
