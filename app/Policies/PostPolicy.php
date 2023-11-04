<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Create a new policy instance.
     * creando el policy php artisan make:policy PostPolicy
     */
    // public function __construct()
    // {
    //     //
    // }


    public function author(User $user, Post $post): Response
    {


        return $user->id === $post->user_id
            ? Response::allow('Permitido')
            : Response::deny('Usted no tiene permitido editar este Post');
    }

    // public function authorDestroy(User $user, Post $post): Response{

    //     if($user->roles->pluck("id")->contains(1)) {
    //         return Response::allow('Permitido');
    //     }


    //     return $user->id === $post->user_id
    //     ? Response::allow('Permitido')
    //     : Response::deny('Usted no tiene permitido eliminar este Post');
    // }


    // public function indice(User $user){
    //     return $user->hasPermissionTo("admin.posts.index")
    //     ? Response::allow('Permitido')
    //     : Response::deny('Usted no tiene permitido ver el Index');
    // }

    public function crear(User $user){

        if($user->roles->pluck("id")->contains(1)) return Response::allow('Permitido');
     

        return ($user->permissions->pluck('name')->contains('admin.posts.create') && $user->permissions->where('name','admin.posts.create')->first()->pivot->status === 1 )
        ? Response::allow('Permitido')
        : Response::deny('Usted no tiene permitido Crear un Post');
    }


    public function verEdicion(User $user,Post $post){
        if($user->roles->pluck("id")->contains(1)) return Response::allow('Permitido');
        

        return  $user->id === $post->user_id  
        ? Response::allow('Permitido')
        : Response::deny('Usted no tiene permitido editar el Post');


    }

    public function editar(User $user){

        if($user->roles->pluck("id")->contains(1)) return Response::allow('Permitido');

        return ($user->permissions->pluck('name')->contains('admin.posts.create') && $user->permissions->where('name','admin.posts.edit')->first()->pivot->status === 1 )
        ? Response::allow('Permitido')
        : Response::deny('Usted no tiene permitido editar un Post');
    }

    public function eliminar(User $user,Post $post){

        if($user->roles->pluck("id")->contains(1)) return Response::allow('Permitido');
    
            return ( $user->id === $post->user_id  && $user->permissions->pluck('name')->contains('admin.posts.destroy') && $user->permissions->where('name','admin.posts.destroy')->first()->pivot->status === 1  )
            ? Response::allow('Permitido')
            : Response::deny('Usted no tiene permitido eliminar un Post');
        

   
    }

    public function published(?User $user,Post $post){
        return $post->status == 2;
    }

}
