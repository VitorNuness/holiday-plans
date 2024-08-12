<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Register extends Controller
{
    public function __invoke(Request $request): MessageResource
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'password' => ['required', 'confirmed', 'max:100', 'min:3'],
        ]);

        $user = User::query()->create($validatedData);
        $token = auth('api')->attempt($validatedData);
        $message = "Register as been successfully.";

        return MessageResource::make(
            message: $message,
            data: [
                'user' => UserResource::make($user),
                'token' => $token,
            ]
        );
    }
}
