<?php


namespace App\Services;

use App\Models\User;

use Auth;

class UserService
{
    public function registerUser(array $data)
    {
        $user = User::create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function loginUser(array $data)
    {
        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $data['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function updateUser(array $data, User $user)
    {
        [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'password' => $password,
        ] = $data;

        $user->name = $name;
        $user->email = $email;
        $user->address = $address;
        $user->password = $password;

        $user->save();
    }
}
