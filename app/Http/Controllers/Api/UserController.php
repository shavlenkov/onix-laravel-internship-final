<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function all()
    {
        $this->authorize('viewAny', User::class);

        return UserResource::collection(User::simplePaginate(config('app.paginate')));
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }

    public function updateProfile(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'address' => 'required',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ]);

        $data['password'] = bcrypt($data['password']);

        $this->userService->updateUser($data, $user);

        return response()
            ->json(['success' => true]);
    }

    public function updateMe(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.auth()->user()->id,
            'address' => 'required',
            'password' => ['required', Password::min(6)->mixedCase()->numbers()],
        ]);

        $data['password'] = bcrypt($data['password']);

        $this->userService->updateUser($data, auth()->user());

        return response()
            ->json(['success' => true]);
    }

    public function deleteProfile(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()
            ->json(['success' => true]);
    }
}
