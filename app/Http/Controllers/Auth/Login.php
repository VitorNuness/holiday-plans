<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Login extends Controller
{
    public function __invoke(Request $request): MessageResource | Response
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! $token = auth('api')->attempt($validatedData)) {
            return response(
                MessageResource::make("Invalid credentials."),
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = auth('api')->user();

        return MessageResource::make(
            message: "Login has been successfully",
            data: [
                'user' => UserResource::make($user),
                'token' => $token,
            ]
        );
    }
}
