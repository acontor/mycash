<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getUser(): User;
    public function updateUser(array $userData): void;
}
