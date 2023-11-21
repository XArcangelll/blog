<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');


Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users')->missing(function () {
  return redirect()->route("admin.users.index")->withErrors("Hubo un error inesperado");
});





Route::get('permissions/{user}/edit',[PermissionController::class,'edit'])->name('admin.permissions.edit')->missing(function () {
  return redirect()->route("admin.users.index")->withErrors("Hubo un error inesperado");
}); 

Route::put('permissions/{user}',[PermissionController::class,'update'])->name('admin.permissions.update')->missing(function () {
  return redirect()->route("admin.users.index")->withErrors("Hubo un error inesperado");
}); 

Route::resource('roles',RoleController::class)->except('show')->names('admin.roles')->missing(function () {
  return redirect()->route("admin.roles.index")->withErrors("Hubo un error inesperado");
});;

Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories')->missing(function () {
  return redirect()->route("admin.categories.index")->withErrors("Hubo un error inesperado");
});

Route::resource('tags', TagController::class)->except('show')->names('admin.tags')->missing(function () {
  return redirect()->route("admin.tags.index")->withErrors("Hubo un error inesperado");
});

Route::resource('posts', PostController::class)->except('show')->names('admin.posts')->missing(function () {
  return redirect()->route("admin.posts.index")->withErrors("Hubo un error inesperado");
});
