<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;

class AuthenticationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
       $response =  UserService::create($request->validated());

       return $response;

    }

    public function login(LoginRequest $request)
    {
        $response = UserService::login($request->validated());

        return $response;

    }

    public function logout(Request $request)
    {
       auth()->user()->tokens()->delete();

       return response([
            'message' => 'Logged Out Successfully'
        ], 200);
    }

    public function refresh(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'access_token' => $request->user()->createToken('api')->plainTextToken,
        ]);
    }

//    public function testTokenExpiration(){
//        dd("token is still valid");
//    }

    public function accessor(){
        $user = User::first();
        return $user;
    }

    public function mutator(Request $request){
        $user = User::first();
        $first_name = $request->first_name;
        $user->first_name = $first_name;
        $user->save();
        return $user->first_name;
    }

}
