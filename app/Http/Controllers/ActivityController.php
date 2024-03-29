<?php

namespace App\Http\Controllers;

use App\Interfaces\ActivityRepositoryInterface;
use Illuminate\Contracts\View\View;

class ActivityController extends Controller
{
    public function __construct(
        private ActivityRepositoryInterface $activityRepository
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view(
            'activities.index',
            [
                'activities' => $this->activityRepository->getAllActivities(),
                'titleRight' => 'Actividades'
            ]
        );
    }
}
