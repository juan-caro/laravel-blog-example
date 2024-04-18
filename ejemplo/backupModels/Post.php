<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all(){

        return cache()->rememberForever("posts.all", function () {
            $files = File::files(resource_path("posts"));
            return collect($files)
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($document) {
                return new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
            })->sortByDesc('date');
        });


        // // Recojo los diferentes posts
        // $files = File::files(resource_path("posts/"));

        // // Recorro el array y devuelvo cada contenido del post
        // return array_map(function($file){
        //     return $file->getContents();
        // }, $files);

        // Misma función que la de antes pero ARROW
        /*
            return array_map(fn($file) => $file->getContents(), $files);
        */
    }


    public static function find($slug)
    {
//         base_path();
//         if(!file_exists($path = resource_path("posts/{$slug}.html"))){
//             throw new ModelNotFoundException();
//         }

// //        return $path;
//         return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
        // dd(static::all()->firstWhere("slug", $slug));

        return static::all()->firstWhere('slug',$slug);

    }

    public static function findOrFail($slug)
    {
//         base_path();
//         if(!file_exists($path = resource_path("posts/{$slug}.html"))){
//             throw new ModelNotFoundException();
//         }

// //        return $path;
//         return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));
        // dd(static::all()->firstWhere("slug", $slug));

        $post = static::find($slug);

        if(!$post){
            throw new ModelNotFoundException();
        }

        return $post;

    }


}
