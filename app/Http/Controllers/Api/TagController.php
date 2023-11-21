<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

class TagController extends Controller
{

    //php artisan make:resource TagResource
    
    public function index()
    {
       //  $tags = Tag::select('id', 'name', 'slug')->get();
             $tags = Tag::all();
          //   $tags = Tag::select()->where('id',80)->get();
        if($tags->isEmpty()){ return response()->json(['data' => null], 404); }
        // return response()->json(["data"=>$tags], 200);
         return TagResource::collection($tags) ;
    }


    public function show($id){
        $tag = Tag::find($id);
        if(!$tag) return response()->json(['data' => null], 404);
      //  return response()->json(["data"=>$tag], 200);
      return response()->json(["data"=>new TagResource($tag)], 200);
    }


    public function store(StoreUpdateTagRequest $request): JsonResponse
    {
        try {
            $tag =  Tag::create($request->all());
            return response()->json(["success" => true,"data"=>new TagResource($tag)], 201);
        } catch (ValidationException $e) {
            return response()->json(["status" => "fail", "data" => $e->errors()], 422);
        }
    }


    public function update(StoreUpdateTagRequest $request,Tag $tag): JsonResponse
    {
        try {
            $tag->update($request->all());
            return response()->json(["success" => true,"data"=>new TagResource($tag)], 201);
        } catch (ValidationException $e) {
            return response()->json(["status" => "fail", "data" => $e->errors()], 422);
        }
    }

    public function destroy(Tag $tag): JsonResponse
    {
        try {
            $tag->delete();
            return response()->json(["success" => true,"data"=>new TagResource($tag)], 201);
        } catch (ValidationException $e) {
            return response()->json(["status" => "fail", "data" => $e->errors()], 422);
        }
    }

}
