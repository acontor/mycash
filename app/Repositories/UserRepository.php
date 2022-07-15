<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUserById()
    {
        return auth()->user();
    }

    public function updateUser(array $userData)
    {
        $user = User::findOrFail(auth()->id());
        $user->update([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => bcrypt($userData['password']),
        ]);
    }
}
