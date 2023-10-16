<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\GuestUser;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        // Check if the guest token is already stored in the session
        if (Session::has('guestToken')) {
            $guestToken = $request->session()->get('guestToken');
        }
        else {
            // If the guest token is not in the session, check if it's provided in the request
            $token = $request->input('token') ?: $request->bearerToken();

            if ($token) {
                // If a token is provided, check if it exists in the database
                $existingGuestUser = GuestUser::where('token', $token)->first();
                if ($existingGuestUser) {
                    // If it exists, store it in the session
                    $guestToken = $existingGuestUser->token;
                    $request->session()->put('guestToken', $guestToken);
                    \session()->save();
                } else {
                    // If it doesn't exist, generate a new token and store it in the database and session
                    $guestToken = Str::random(32);
                    $guestUser = GuestUser::create(['token' => $guestToken]);
                    $request->session()->put('guestToken', $guestToken);
                    \session()->save();
                }
            } else {
                // If no token is provided, generate a new token and store it in the database and session
                $guestToken = Str::random(32);
                $guestUser = GuestUser::create(['token' => $guestToken]);
                $request->session()->put('guestToken', $guestToken);
                \session()->save();
            }
        }


        return response()->json([
            'message' => 'Guest user token retrieved or created.',
            'token' => $guestToken,
        ]);
    }
}
