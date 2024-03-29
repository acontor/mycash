<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ActivityRepositoryInterface
{
    public function getAllActivities(): Collection;
}
