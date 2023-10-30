<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\GuestUser;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        // Create new user.
//        if($request->token == null){
        return $this->register($request);
//        }
//        else{
//            return response([
//                'message' => 'user already signed in.',
//                'user' => $request->user() ?? $request->user,
//                'token' => $request->token,
//            ]);
//        }
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'admin', // password
            'remember_token' => Str::random(10),
        ]);

        // Create a Sanctum token for the user
        $token = $user->createToken('Api token of ' . $user->remember_token);

        return response()->json([
            'message' => 'Random user created.',
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }
}
