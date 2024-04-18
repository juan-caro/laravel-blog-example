<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // En caso de crear manual se deben truncar los modelos
        // User::truncate();
        // Post::truncate();
        // Category::truncate();

        //Crear un usuario con un nombre en concreto
        $user = User::factory()->create([
            'username' => 'juancr',
            'name' => 'John Marston',
            'email'=> 'juancr@email.com',
            'password' => 'juan123',
            'is_admin' => true,
        ]);

        // Crear 5 posts con contenido random, tanto usuarios como categorías
        // Post::factory(5)->create();

        // Override del usuario autor de los posts
        Post::factory(5)->create([
            'user_id'=> $user->id,
        ]);


        //Antes de crear todas las factories correctamente se haría así manualmente

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-first-post',
        //     'excerpt' => 'Excerpt of the first family post',
        //     'body' => 'Thats the body of the first family post. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'

        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => 'Excerpt of the first family post',
        //     'body' => 'Thats the body of the first family post. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'

        // ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'is_admin' => '0',
        // ]);
    }
}
