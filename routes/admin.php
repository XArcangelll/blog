<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;


Route::get('',[HomeController::class,'index'])->name('admin.home');
Route::resource('categories', CategoryController::class)->names('admin.categories')->missing(function(){
    return redirect()->route("admin.categories.index")->withErrors("Hubo un error inesperado");
  }) ;

  Route::resource('tags', TagController::class)->names('admin.tags')->missing(function(){
    return redirect()->route("admin.tags.index")->withErrors("Hubo un error inesperado");
  }) ;

  Route::resource('posts', PostController::class)->names('admin.posts')->missing(function(){
    return redirect()->route("admin.posts.index")->withErrors("Hubo un error inesperado");
  }) ;