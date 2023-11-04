<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    // php artisan make:observer PostObserver --model=Post
    //ese es el codigo para hacer un obesrver relacionado a un modelo
    //en todo caso si quires el observer se dispare antes de borrar o crear en vez de terminar en ed que termine en ing por ejemplo creating or deleting
    //para que entre en funcionamiento este postobserver tienes que ir a app providers eventserviceprovider
    // y en el boot  Post::observe(PostObserver::class);

    
    public function creating(Post $post): void
    {
        // cada vez que se crea un nuevo post en el campo de user_id tomara el valor de auth user id del momento
        // cosa que ya no necesitarias pasar ese dato en el frontend
     

        if(!app()->runningInConsole()){
            $post->user_id = auth()->user()->id;
        }

    }

    public function deleting(Post $post): void
    {
      
        if($post->image){
            Storage::delete($post->image->url);
        }

    }
}
