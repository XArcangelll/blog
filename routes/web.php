<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//Si quieres crear un componente php artisan make:component Componente

Route::fallback(function(){
  return redirect()->route("posts.index");
});



//aqui el detalle de {tag} o {category} es que en el modelo debes escribir esto
// public function getRouteKeyName(){
//     return "slug";
// }
//para que filtre mediante el slug y no por el id 
//en caso de que no quieras escribir eso para que filtre mediante el slug simplemente
//aqui en la ruta escribes {post:slug} y se encargara de filtrar mediante el slug 


Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name("posts.index");
    Route::get('post/{post:slug}',"show")->name('posts.show')->missing(function(){
        return redirect()->route("posts.index");
    });
    Route::get('category/{category}','category')->name('posts.category')->missing(function(){
        return redirect()->route("posts.index");
    });

    Route::get('tag/{tag:slug}','tag')->name('posts.tag')->missing(function(){
        return redirect()->route("posts.index");
    });

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
