<?php

namespace App\Http\Controllers;

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
}
