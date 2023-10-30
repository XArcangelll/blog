<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return $this->user_id == auth()->user()->id;
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
            "slug" => "required|unique:posts",
            "status" => "required|in:1,2",
            "file" => 'image'
        ];

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
