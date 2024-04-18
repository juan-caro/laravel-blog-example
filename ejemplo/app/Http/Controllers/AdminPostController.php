<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    //
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }

    public function create(){

        if(auth()->user()?->username != 'juancr'){
            abort(Response::HTTP_FORBIDDEN);
        }
        return view('admin.posts.create');
    }

    public function store(){


        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at' => 'required'
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

         Post::create($attributes);

        return redirect('/posts');
    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post'=> $post]);
    }

    public function update(Post $post){

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'published_at' => 'required'
        ]);

        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($attributes);

        return back()->with('success','Post Updated!');
    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success','Post Deleted!');
    }
}
