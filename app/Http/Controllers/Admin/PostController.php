<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

        return redirect()->route('admin.posts.edit', $post)->with('info', "El Post se creó con éxito");
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
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view("admin.posts.edit", compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

       

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
        //
    }
}
