<?php

use App\Http\Controllers\PostController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome'); // welcome.blade.php 
})->name('welcome');


Route::prefix('post')->name('post.')->group(function () {

    Route::get('/hello', function () {
        return 'Hello Dawan';
    })->name('hello');

    Route::get('/show/{slug}-{id}', function(string $slug, int $id) {
        return [
            'slug' => $slug,
            'id' => $id
        ];
    })->where(name: ['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])->name('show'); 

    Route::get('/data', function (Request $request) {
    return [
        'name' => $request->input('names', 'Zineb'),
        'value' => $request->input('value', '25'),
        'all' => $request->all()
    ];
    })->name('data');

    // Les redirections 
    Route::get('/new', function() {
        // return [
        //     //'welcome' => route('post.data'), // post.data
        //     'hello' => route('post.hello')
        // ];

        //return to_route('post.show', ['id' => 96, 'slug' => 'new-article-laravel33']);
        //return redirect()->route('welcome');
        return redirect()->route('post.data');

    });
});

*/

Route::get('/', 'App\Http\Controllers\BlogController@index')->name('welcome');

Route::prefix(prefix: 'blog')->namespace('App\Http\Controllers')->name('blog.')->group(function() {

   Route::get('/show/{slug}-{id}', 'BlogController@show')
        ->where(name: ['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])
        ->name('show');

    Route::get('/categories', 'BlogController@categories')->name('categories');
     Route::get('/categories/show/{id}', 'BlogController@showCategory')->name('show.category');
});

// Mise en place des routes pour l'administration du site
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
});

// La route de secours (404)
Route::fallback(function() {
    return "Ooops Cette page n'existe pas !";
});






