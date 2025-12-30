<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input)
    {
        $requestInstance = app(RegisterRequest::class);

        Validator::validate(
            $input,
            $requestInstance->rules(),
            $requestInstance->messages()
        );

        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
