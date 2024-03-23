<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUserById();
    public function updateUser(array $userData);
}
