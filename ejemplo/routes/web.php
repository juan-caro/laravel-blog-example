<?php

use App\Http\Middleware\MustBeAdministrator;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\NewsletterController;
use App\Services\Newsletter;
use App\Models\User;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::get('/', function () {


    return view('welcome');
});


Route::post('/posts/newsletter', NewsletterController::class);

Route::get('/posts', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->where('slug', '[A-z_\-]+'); // slug hace referencia a la ruta /posts/{slug}. Hace que solo se acepten esos caracteres
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class,'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');

Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('admin/posts', [AdminPostController::class,'index'])->middleware(MustBeAdministrator::class);
Route::get('admin/posts/create', [AdminPostController::class,'create'])->middleware(MustBeAdministrator::class);

Route::post('admin/posts', [AdminPostController::class,'store'])->middleware(MustBeAdministrator::class);
Route::get('admin/posts/{post}/edit', [AdminPostController::class,'edit'])->middleware(MustBeAdministrator::class);
Route::patch('admin/posts/{post}', [AdminPostController::class,'update'])->middleware(MustBeAdministrator::class);
Route::delete('admin/posts/{post}', [AdminPostController::class,'destroy'])->middleware(MustBeAdministrator::class);
