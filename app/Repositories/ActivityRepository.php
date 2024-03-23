<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getAllActivities()
    {
        return auth()->user()->activities;
    }
}
