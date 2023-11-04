<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        //aqui el detalle tambien tiene que ver si quieres juntar los 2 formrequest
        //borre el input user_id del form del edit porque no tiene mucho sentido pero pues
        

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //esto agarra la ruta de $post o sea del update
        $post = $this->route()->parameter("post");


        $rules = [
            "name" => "required",
            "slug" => [
                "required",
                "unique:posts,slug,".$post->id,
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($this->name); // Convierte el name en un slug
                    if ($value !== $slug) {
                        $fail("$attribute debe ser igual al slug de name.");
                    }
                },
            ],
            "status" => "required|in:1,2",
            "file" => 'image',
            'imagen_actual' => 'present'
        ];

        //si quieres usar este formquest para el store y update
        //aqui el codigo

        // if($post){
        //     $rules["slug"] = "required|unique:posts,slug,".$post->id;
        // }

        if($this->status == 2){
            $rules = array_merge($rules,[
                "category_id"=> "required|exists:categories,id",
                "tags"=>"required|array",
                "tags.*"=>"exists:tags,id",
                "extract"=> "required",
                "body"=> "required"
            ]);
        }

        return $rules;

    }

    public function messages()
    {
         return [
            'tags.required' => 'debe seleccionar una etiqueta como mínimo',
            'tags.*.exists' => "debe ser una Etiqueta válida"
         ];
    }
}
