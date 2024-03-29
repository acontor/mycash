<?php

namespace App\Http\Controllers;

use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = $this->activityRepository->getAllActivities();

        return view(
            'activities.index',
            [
                'activities' => $activities,
                'title'      => 'Notificaciones'
            ]
        );
    }
}
