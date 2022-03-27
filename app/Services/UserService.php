<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function create(array $data)
    {
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->status = 'active';
        
        if($user->save())
        {
            $token = $user->createToken('timeTrackerToken')->plainTextToken;
            $response = [
                'user'  => $user,
                'token' => $token
            ];
            return $response;
        }

        return response('Can not save user');
       
    }

    public static function login(array $data)
    {

       $user = User::where('email',$data['email'])->first();       
    
       if(!$user || !Hash::check($data['password'], $user->password))
       {
           return response([
               'message'=>'Bad Credientials'],
               401 );
       }

       $token = $user->createToken('timeTrackerToken')->plainTextToken;
       $response = [
        'user'  => $user,
        'token' => $token
        ];

       return response($response, 201);
 
    }

}
