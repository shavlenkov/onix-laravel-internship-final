<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\SignupUserRequest;
use App\Http\Requests\SigninUserRequest;
use App\Services\UserService;
use Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function postSignup(SignupUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        return $this->userService->registerUser($data);
    }

    public function postSignin(SigninUserRequest $request)
    {
        $data = $request->validated();

        return $this->userService->loginUser($data);
    }

    public function getSignout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()
            ->json(['success' => true]);
    }
}
