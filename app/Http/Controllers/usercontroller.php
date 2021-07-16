<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usercontroller extends Controller
{
    public function store(Request $req)
    {

        $input = $req->all();
        $input['password'] = Hash::make($req->password);

        User::create($input);

        return response()->json([
            'res' => true,
        ], 200);
    }


    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if (!is_null($user) && Hash::check($req->password, $user->password)) {

            $token = $user->createToken('passport')->accessToken;

            return response()->json([
                'res' => true,
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'invalid credentials'
            ], 200);
        }
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(
            [
                'res' => true,
                'message' => "Adios"
            ]
        );
    }
}
