<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct(){
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create','store');
        $this->middleware('can:admin.tags.edit')->only('edit','update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
     }


    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $colors = [
            'red' => 'Color Rojo',
            "blue" => 'Color Azul',
            "green" => "Color Verde",
            "indigo" => "Color Indigo",
            "pink" => "Color Rosa",
            "orange" => "Color Naranja",
            "yellow" => "Color Amarillo",
            "purple" => "Color púrpura"
        ];

        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|unique:tags',
            "color"=> 'required|in:red,pink,yellow,purple,green,indigo,blue,orange'
        ]);

        $slug =  Str::slug($request->name);

        if($slug != $request->slug) return redirect()->route('admin.tags.index');
        

        $tag = Tag::create($request->all());

        return redirect()->route('admin.tags.edit',$tag)->with('info',"La Etiqueta se creó con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {

        $colors = [
            'red' => 'Color Rojo',
            "blue" => 'Color Azul',
            "green" => "Color Verde",
            "indigo" => "Color Indigo",
            "pink" => "Color Rosa",
            "orange" => "Color Naranja",
            "yellow" => "Color Amarillo",
            "purple" => "Color púrpura"
        ];

        return view('admin.tags.show',compact('tag','colors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {  $colors = [
        'red' => 'Color Rojo',
        "blue" => 'Color Azul',
        "green" => "Color Verde",
        "indigo" => "Color Indigo",
        "pink" => "Color Rosa",
        "orange" => "Color Naranja",
        "yellow" => "Color Amarillo",
        "purple" => "Color púrpura"
    ];
        return view('admin.tags.edit',compact('tag','colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=> 'required',
            'slug'=> "required|unique:tags,slug,$tag->id",
            "color"=> 'required|in:red,pink,yellow,purple,green,indigo,blue,orange'
        ]);

        $slug =  Str::slug($request->name);

        if($slug != $request->slug) return redirect()->route('admin.tags.index');
        

        $tag->update($request->all());

        return redirect()->route('admin.tags.edit',$tag)->with('info',"La Etiqueta se actualizó con éxito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('info',"La etiqueta se eliminó con éxito");
    }
}
