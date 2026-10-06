<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|min:8",

        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password"=> Hash::make($data["password"]),
        ]);

        return response()->json([
            "message" => "registered sucess",
            "user" => $user,
        ]);
    }

    public function login(Request $request){
         $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
         ]);

        $user = [
            "email" => $data["email"],
            "password" => $data["password"],
        ];

        if(!$token = JwtAuth::attempt($user)){
        return response()->json([
            "message"=> "invalid credentials"
        ], 401);
        }

       return $this->getToken($token);

   
    }

    public function getToken($token){
        return response()->json([
             "access_token" => $token,
             "token_type" => 'bearer',
             "expires_in" => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}
