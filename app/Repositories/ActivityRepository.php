<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getAllActivities(): Collection
    {
        return auth()->user()->activities;
    }
}
