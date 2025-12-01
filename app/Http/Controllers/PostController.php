<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $title = "Bienvenue chez Dawan";
        $description = "<h3>Bienvenue dans la description du Framework Laravel</h3>"; // XSS

        $posts = [
            [
                "id" => 1,
                "title" => 'new post 1',
                "description" => 'new post description 1',
                "imageUrl" => 'https://picsum.photos/300'
            ],
              [
                "id" => 2,
                "title" => 'new post 2',
                "description" => 'new post description 2',
                "imageUrl" => 'https://picsum.photos/300'
              ],
                [
                "id" => 3,
                "title" => 'new post 3',
                "description" => 'new post description 3',
                "imageUrl" => 'https://picsum.photos/300'
                ],
                  [
                "id" => 4,
                "title" => 'new post 4',
                "description" => 'new post description 4',
                "imageUrl" => 'https://picsum.photos/300'
            ]

        ];

        //dd($posts);

        return view('blog', ['title' => $title, 'description' => $description, 'posts' => $posts]);
    }

    public function hello(): ?string
    {
        return 'Hello World 30';
    }

    public function show(string $slug, int $id): array
    {
        return [
            'slug' => $slug,
            'id' => $id
        ];
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
