<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateRequestUser extends FormRequest
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
        return [
                "name" => "required|unique:users,name",
                "email" => "required|email|unique:users,email",
                "password" =>"required|min:3"
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
       
          return  response()->json($errors, 422);
       
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(['message' => 'No tienes permiso para realizar esta acción.'], 403)
        );
    }

}
