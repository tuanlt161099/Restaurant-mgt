<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\test;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request){
        $fields =  $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // $token = $user->createToken('myapptoken')->plainTextToken;

        // $data = [
        //     'user' => $user,
        //     'token' => $token,
        // ];
        $response = [
            "status" => "success",
            "data" => [],
            "message" => "Registered success"
        ];

        return response($response, 201);

        
    }


    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => "Logged out"
        ];

    }

    public function login(Request $request){
        $fields = $request->validate([
            //unique users table and email field
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

       //check email
        $user = User::where('email',$fields['email'])->first();
        if(!$user){
             return response([
                 "status" =>"failed",
                'message' =>"Email not existed"
            ],401);
        }

        if( !Hash::check($fields['password'], $user->password)){
            return response([
                "status" =>"failed",
                'message' =>"Password was incorrect"
            ],401);
        };

        $token = $user->createToken('myapptoken')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        $response = [
            "status" =>"success",
            "data" => $data,
            "message" => "Loggin successfully"
        ];

        return response($response, 201);
    }

}
