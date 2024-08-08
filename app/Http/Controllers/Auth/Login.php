<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Login extends Controller
{
    public function __invoke(Request $request): Response
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! $token = auth('api')->attempt($validatedData)) {
            return response([], Response::HTTP_UNAUTHORIZED);
        }

        return response(['token' => $token]);
    }
}
