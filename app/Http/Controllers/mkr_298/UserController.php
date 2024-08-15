<?php

namespace App\Http\Controllers\mkr_298;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'user' =>$user]);
    }
    public function logout(Request $request) {
       $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'logged out '], 200);
    }
}
