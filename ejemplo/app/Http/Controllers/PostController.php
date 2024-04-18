<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\Response as AuthResponse;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
     public function index(){

        // return Post::latest()->filter(
        //     request(['search', 'category', 'author'])
        // )->paginate(3);

        // \Illuminate\Support\Facades\DB::listen(function($query){
        //     //\Illuminate\Support\Facades\Log::info('foo');
        //     logger($query->sql, $query->bindings);
        // });

        //Traer un único post
    /*  $document = YamlFrontMatter ::parse(file_get_contents(
            resource_path('posts/my-fourth-post.html')
        ));*/
        //$posts = Post::all();
        //$files = File::files(resource_path('posts'));

    /*    $posts = collect($files)
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($file) {
                $document = YamlFrontMatter::parse(file_get_contents($file));
                return new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
            });*/

        /*$posts = array_map(function ($file) {
            $document = YamlFrontMatter::parseFile($file);
            return new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
        }, $files);*/




    // ddd($posts[0]->title);



        return view('posts.index', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString()
        ]);

        //Consultar metadatos
        //ddd($document->matter('title'));
        //ddd($document->matter('excerpt'));
        //ddd($document->matter('date'));
        //$posts = Post::all();

        //ddd($posts);

        // return view('posts', [
        //     'posts' => Post::all()
        // ]);
    }

    public function show(Post $post){
        //********ENCONTRAR UN POST POR SU SLUG Y PASARLO A UNA VISTA LLAMADA POST**********


        //-------------PRIMERA PARTE------------------------------

        // Recojo el path del html a mostrar
        //$path = __DIR__ . "/../resources/posts/{$slug}.html";

        //ddd($path);


        // Compruebo que el archivo exista
        // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        //     //Hay varias formas de gestionar esto
        //     return redirect("/"); // Vuelvo a la página principal
        //     //abort(404); // Mando un abort con el error 404 de que no se ha encontrado el archivo
        //     //dd('file not found'); // Muestro un mensaje de vuelta
        // }
        // //return $path;


        // /*$post = cache()->remember("posts.{$slug}", 1200, function() use($path){
        //     var_dump('file_get_contents');
        //     return file_get_contents($path);

        // });*/

        // $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

        // // Recojo el contenido del html
        // //$post = file_get_contents($path);
        // //return $post;

        // // Lo devuelvo a post
        // return view('post',[
        //     'post'=> $post
        // ]);

        //-----------------------SEGUNDA PARTE----------------------------------

        //ddd($post);

        return view('posts.show', [
            'post' => $post
        ]);
    }



}
