<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequestUser;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


        public function create(CreateRequestUser $request){
            try {
                $user = User::create(
                    $request->all()
                );

                return response()->json(["success" => true,"message"=>"Usuario creado correctamente","token"=> $user->createToken("API TOKEN")->plainTextToken], 201);
            } catch (ValidationException $e) {
                return response()->json(["status" => "fail", "data" => $e->errors()], 422);
            }
        }


        public function login(LoginRequest $request){
            try {
                if(!Auth::attempt($request->only(["email","password"]))){
                    return response()->json([
                            "status"=>false,
                            "message"=>"Email y/o password Incorrectos"
                    ],401);
                }

                $user = User::where('email',$request->email)->first();

                return response()->json(["success" => true,"message"=>"Usuario Logeado correctamente","token"=> $user->createToken("API TOKEN")->plainTextToken], 201);
            } catch (ValidationException $e) {
                return response()->json(["status" => "fail", "data" => $e->errors()], 422);
            }
        }
}
