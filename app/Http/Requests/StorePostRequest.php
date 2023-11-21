<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // return $this->user_id == auth()->user()->id;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required",
            "slug" => [
                "required",
                "unique:posts",
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($this->name); // Convierte el name en un slug
                    if ($value !== $slug) {
                        $fail("$attribute debe ser igual al slug de name.");
                    }
                },
            ],
            "category_id"=> "required|exists:categories,id",
            "status" => "required|in:1,2",
            "file" => 'image'
        ];

        if($this->status == 2){
            $rules = array_merge($rules,[
              
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
