<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\Authenticate;
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

Route::get('/', 'App\Http\Controllers\BlogController@index')->name('welcome');//->middleware('auth');
Route::get('/register', 'App\Http\Controllers\BlogController@register')->name('register')->middleware('guest');
Route::post('/register/save', 'App\Http\Controllers\BlogController@registerSave')->name('register.save');
Route::get('/login', 'App\Http\Controllers\BlogController@login')->name('login')->middleware('guest');
Route::post('/login/authenticate', 'App\Http\Controllers\BlogController@authenticate')->name('login.authenticate');
Route::delete('/logout', 'App\Http\Controllers\BlogController@logout')->name('logout');


Route::prefix(prefix: 'blog')->namespace('App\Http\Controllers')->name('blog.')->group(function() {

   Route::get('/show/{slug}-{id}', 'BlogController@show')
        ->where(name: ['id' => '[0-9]+', 'slug' => '[a-z0-9-]+'])
        ->name('show');

    Route::get('/categories', 'BlogController@categories')->name('categories');
     Route::get('/categories/show/{id}', 'BlogController@showCategory')->name('show.category');
});

// Mise en place des routes pour l'administration du site
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function() {
    // Routes des posts
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/view/{id}', [PostController::class, 'view'])->name('post.view');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

    // Routes des Catégories
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
    Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');
    Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');
    Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');
    Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');
    Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');
    Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');

    // Routes des utilisateurs
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');
    Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
    Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::put('/users/speed/{user}', 'App\Http\Controllers\UserController@updateSpeed')->name('user.update.speed');
    Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');
});


// La route de secours (404)
Route::fallback(function() {
    return "Ooops Cette page n'existe pas !";
});