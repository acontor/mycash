<?php

namespace App\Interfaces;
use App\Models\Goal;

interface GoalRepositoryInterface
{
    public function createGoal(array $goalData): Goal;
    public function updateGoal(Goal $goal, array $goalData): void;
    public function deleteGoal(Goal $goal): void;
}
