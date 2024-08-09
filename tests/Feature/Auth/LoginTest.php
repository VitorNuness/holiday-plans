<?php

use App\Models\User;

use function Pest\Laravel\postJson;

it('should be able user to login', function () {
    User::factory()->create([
        'email' => 'john.doe@email.com',
        'password' => 'password',
    ]);

    postJson(route('auth.login'), [
        'email' => 'john.doe@email.com',
        'password' => 'password',
    ])->assertSuccessful()
        ->assertJsonStructure(['token']);
});

it('should be require email to login', function () {
    postJson(route('auth.login'), [
        'email' => '',
        'password' => 'password',
    ])->assertInvalid([
        'email' => 'required',
    ]);
});

it('should be require password to login', function () {
    postJson(route('auth.login'), [
        'email' => 'john.doe@email.com',
        'password' => '',
    ])->assertInvalid([
        'password' => 'required',
    ]);
});

it('should be dont login with wrong credentials', function () {
    User::factory()->create([
        'email' => 'john.doe@email.com',
        'password' => 'password',
    ]);

    postJson(route('auth.login'), [
        'email' => 'john.doe@email.com',
        'password' => 'aaaaaaa',
    ])->assertUnauthorized();
});
