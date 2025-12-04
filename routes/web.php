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
    Route::get('/posts/view/{id}', [PostController::class, 'view'])->name('post.view');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
});

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Categories datas
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');

    //Show Category by Id
    Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

    //Get Categories by Id
    Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');

    //Edit Category by Id
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');

    //Save new Category
    Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');

    //Update One Category
    Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');

    //Update One Category Speedly
    Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');

    //Delete Category
    Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');

});


// La route de secours (404)
Route::fallback(function() {
    return "Ooops Cette page n'existe pas !";
});