<?php

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

Route::get('/', 'App\Http\Controllers\PostController@index')->name('welcome');

Route::prefix('post')->namespace('App\Http\Controllers')->name('post.')->group(function() {

    Route::get('/hello', 'PostController@hello')->name('hello');

   Route::get('/show/{slug}-{id}', 'PostController@show')
        ->where(name: ['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])
        ->name('show');

    Route::get('/data', 'PostController@data')->name('data');
    Route::get('/new', 'PostController@new')->name('new');
});

// La route de secours (404)
Route::fallback(function() {
    return "Ooops Cette page n'existe pas !";
});






