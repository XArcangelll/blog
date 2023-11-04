<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct(){
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
     }


    public function index(){
    // 
    //     $this->authorize('indice', Post::class);
    //     $user = auth()->user();
    //   return  $user->permissions;

        return view("admin.posts.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view("admin.posts.create", compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // en caso que no quieras incluir el input user_id en el formulario
        // $datos = $request->all();
        // $datos["user_id"] = auth()->user()->id;

        // return $request->file("file");

        // php artisan storage::link para q se muestre el acceso directo en public
        //return  Storage::put("posts",$request->file('file'));


        // $slug =  Str::slug($request->name);

        // if($slug != $request->slug) return redirect()->route('admin.posts.index');

        // $this->authorize('crear');


        $this->authorize('crear', Post::class);


        $post = Post::create($request->all());

        if ($request->file("file")) {
            $url = Storage::put("posts", $request->file('file'));

            $post->image()->create([
                "url" => $url,

            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('info', "El Post se creó con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {



        return view("admin.posts.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {


        // $this->authorize('author',$post);

        $this->authorize('verEdicion', $post);
        // $this->autorizacion($post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view("admin.posts.edit", compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {


        $this->autorizacion($post);
        $this->authorize('editar', Post::class);


        


        $post->update($request->all());

        if ($request->file("file")) {
            $url = Storage::put("posts", $request->file('file'));

            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    "url" => $url
                ]);
            } else {
                $post->image()->create([
                    "url" => $url,
                ]);
            }
        } else {
            if (!$request->imagen_actual) {
                if ($post->image) {
                    Storage::delete($post->image->url);
                    $post->image()->delete();
                }
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }else{
            $post->tags()->detach();
        }

        return  redirect()->route("admin.posts.edit", $post)->with("info", "El post se actualizó con éxito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        
        $this->authorize('eliminar', $post);
        $post->delete();
        return  redirect()->route("admin.posts.index")->with("info", "El post se eliminó con éxito");
    }

     private function autorizacion($post){
        
    //     $response =  Gate::inspect('author', $post);

    //     if(!$response->allowed()){
    //         return redirect()->route("admin.posts.index")->with("info", "Usted no tiene permitido eso");
    //     } 

    $this->authorize('author',$post);

     }
}
