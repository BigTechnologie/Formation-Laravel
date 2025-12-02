<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use EsperoSoft\Faker\Faker;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index()
    {
        $title = "Bienvenue chez Dawan";
        $description = "<h3>Bienvenue dans la description du Framework Laravel</h3>"; // XSS
        /*
        $posts = [
            [
                "title" => 'new post 5',
                "content" => 'new post 5',
                "description" => 'new post description 5',
                "imageUrl" => 'https://picsum.photos/300'
            ],
              [
                 "title" => 'new post 6',
                "content" => 'new post 6',
                "description" => 'new post description 6',
                "imageUrl" => 'https://picsum.photos/300'
              ],
                [
                 "title" => 'new post 7',
                "content" => 'new post 7',
                "description" => 'new post description 7',
                "imageUrl" => 'https://picsum.photos/300'
                ],
                  [
                "title" => 'new post 8',
                "content" => 'new post 8',
                "description" => 'new post description 8',
                "imageUrl" => 'https://picsum.photos/300'
            ]

        ];
        */
        //dd($posts);
        // $post = new Post();
        // $post->title = 'new article 2';
        // $post->description = 'new description 2';
        // $post->content = 'new content 2';
        // $post->imageUrl = 'https://picsum.photos/300';
        // //dd($post);
        // $post->save();

        // On charge les données du tableau en BDD
        // foreach($posts as $post) {
        //     Post::create($post);
        // }

        // Affichage des données depuis la tables posts 
        //$posts = Post::all(); return view('blog', ['title' => $title, 'description' => $description, 'posts' => $posts]);

        // Manipulation des articles avec Eloquent
        //$post = Post::find(1); return $post;
        //$posts = Post::where('id', '>', 2)->get(); return view('blog', ['title' => $title, 'description' => $description, 'posts' => $posts]);
        //$posts = Post::where(['title' => 'new post 7'])->get(); return view('blog', ['title' => $title, 'description' => $description, 'posts' => $posts]);
        //$posts = Post::where('title', 'like', '%post%')->get(); return view('blog', ['title' => $title, 'description' => $description, 'posts' => $posts]);
       
        // Pour paginer
        //$posts = Post::paginate(2); return $posts;
        // Edit
        //$post = Post::find(1); $post->title = 'Bienvenue sur la formation Laravel + vue.js'; $post->save(); return $post;
        // Suppression
        // $post = Post::find(3); 
        // if($post) {
        //     $post->delete();
        // }else {
        //     echo "Cet article n'existe pas en BDD";
        // }
        /*
        $faker = new Faker();
        for($i = 0; $i < 200; $i++) {
        $title = $faker->title(30);
            Post::create([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $faker->title(60),
                "content" => $faker->text(),
                "imageUrl" => $faker->image()
            ]);
        }
        $posts = Post::all();
       */

        $posts = Post::paginate(24); // 48 articles => p1: 24; p2:24
        return view('posts.home', ['title' => $title, 'description' => $description, 'posts' => $posts]);

    }

    public function show(string $slug, int $id)
    {
        $post = Post::find($id);
        if($post->slug !== $slug) {
            return to_route('post.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('posts.show', ['post' => $post]);
    }
    public function hello(): ?string
    {
        return 'Hello World 30';
    }

    public function data(Request $request)
    {
        return [
            'name' => $request->input('names', 'Zineb'),
            'value' => $request->input('value', '25'),
            'all' => $request->all()
        ];
    }

    public function new()
    {
        // return [
        //     //'welcome' => route('post.data'), // post.data
        //     'hello' => route('post.hello')
        // ];

        //return to_route('post.show', ['id' => 96, 'slug' => 'new-article-laravel33']);
        //return redirect()->route('welcome');
        return redirect()->route('post.data');

    }


}
