<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Str;

class StoreUpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if($this->route()->parameter("tag")){
            $tag = $this->route()->parameter("tag");
            $tagid = $tag->id;
        }else{
            $tagid = "";
        }


        return [
            'name'=> 'required',
            "slug" => [
                "required",
                "unique:tags,slug,".$tagid,
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($this->name); // Convierte el name en un slug
                    if ($value !== $slug) {
                        $fail("$attribute debe ser igual al slug de name.");
                    }
                },
            ],
            "color"=> 'required|in:red,pink,yellow,purple,green,indigo,blue,orange'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json($errors, 422)
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(['message' => 'No tienes permiso para realizar esta acción.'], 403)
        );
    }


}
