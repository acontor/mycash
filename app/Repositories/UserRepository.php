<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUser(): User
    {
        return User::findOrFail(auth()->id());
    }

    public function updateUser(array $userData): void
    {
        $user = User::findOrFail(auth()->id());
        $user->update([
            'email'    => $userData['email'],
            'name'     => $userData['name'],
            'password' => bcrypt($userData['password']),
        ]);
    }
}
