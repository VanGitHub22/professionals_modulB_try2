<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Token;

class UserController extends Controller
{
    //Frontend функционал

    function regForm(){
        return view("auth/register");
    }

    function register(Request $request){
        $user = User::create([
            "email" => $request->email,
            "name" => $request->name,
            "date" => $request->date,
            "password" => Hash::make($request->password),
            "is_admin" => 0,
        ]);

        Auth::login($user);
        return redirect("/courses");
    }

    function logForm(){
        return view("auth/login");
    }

    function login(Request $request){
        auth()->attempt([
            "email" => $request->email,
            "password" => $request->password,
        ]);

        return redirect("/courses");
    }

    function logout(Request $request){
        auth()->logout();

        return redirect("/login");
    }

    //api функцуионал

    public function apiRegister(Request $request){
        $email = $request->input("email");
        $password = $request->input("password");

        User::create([
            "email" => $email,
            "name" => "Имя",
            "date" => "1970-01-01",
            "password" => Hash::make($password),
            "is_admin" => 0,
        ]);

        return response()->json([
            "success"=> true
        ], 201);
    }

    public function apiLogin(Request $request){
        $email = $request->input("email");
        $password = $request->input("password");
        $user = User::where("email", $email)->first();
        if(Hash::check($password, $user->password)){
            $token = Token::updateOrCreate(["user_id" => $user->id], ["token" => Hash::make($user->email.time())]);
            return response()->json([
                "token" => $token->token
            ], 200);
        } else {
            return response()->json([
                "message" => "invalid data",
                "errors" => [
                    "email" => "invalid data"
                ]
            ], 422);
        }


        return response()->json([
            "success"=> true
        ], 201);
    }

    public function apiLogout(Request $request){
        $token = $request->bearerToken();
        Token::where("token", $token)->delete();
        return response()->json([
            "success" => true
        ], 200);
    }
}
