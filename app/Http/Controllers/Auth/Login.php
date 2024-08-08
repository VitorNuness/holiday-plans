<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function __invoke(Request $request): Response
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! $token = auth()->attempt($validatedData)) {
            return response([], Response::HTTP_UNAUTHORIZED);
        }

        return response(['token' => $token]);
    }
}
