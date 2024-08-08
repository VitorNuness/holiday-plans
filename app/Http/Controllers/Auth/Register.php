<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class Register extends Controller
{
    public function __invoke(Request $request): Response
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'password' => ['required', 'confirmed', 'max:100', 'min:3'],
        ]);

        User::query()->create($validatedData);
        $token = auth('api')->attempt($validatedData);

        return response(['token' => $token]);
    }
}
