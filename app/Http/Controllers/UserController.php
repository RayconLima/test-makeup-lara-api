<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\{StoreUserRequest, UpdateUserRequest};
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return UserResource::make($user);
    }

    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());
        return UserResource::make($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
