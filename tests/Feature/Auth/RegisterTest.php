<?php

use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to register a new user and retrieve the token to auth', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertSuccessful()
        ->assertJsonStructure(['token']);

    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
    ]);
});

it('should be require name to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => '',
        'email' => 'john.doe@email.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'name' => 'required',
    ]);
});

it('should be max of 50 characters for name to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => str_repeat('a', 51),
        'email' => 'john.doe@email.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'name' => 'greater than 50',
    ]);
});

it('should be require email to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => '',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'email' => 'required',
    ]);
});

it('should be valid email to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'aaa',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'email' => 'valid',
    ]);
});

it('should be unique email to register a new user', function () {
    $user = User::factory()->create();

    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'email' => 'already been taken',
    ]);
});

it('should be max of 100 characters for email to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => str_repeat('a', 101),
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'email' => 'greater than 100',
    ]);
});

it('should be require password to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
        'password' => '',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'password' => 'required',
    ]);
});

it('should be password confirmation to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
        'password' => 'password',
        'password_confirmation' => '',
    ])->assertInvalid([
        'password' => 'confirmation',
    ]);
});

it('should be max of 100 characters password to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
        'password' => str_repeat('a', 101),
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'password' => 'greater than 100',
    ]);
});

it('should be min of 3 characters password to register a new user', function () {
    postJson(route('auth.register'), [
        'name' => 'John Doe',
        'email' => 'john.doe@email.com',
        'password' => 'aa',
        'password_confirmation' => 'password',
    ])->assertInvalid([
        'password' => 'least 3',
    ]);
});
