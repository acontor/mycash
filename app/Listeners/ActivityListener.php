<?php

namespace App\Listeners;

use App\Events\ActivityEvent;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivityListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ActivityEvent  $event
     * @return void
     */
    public function handle(ActivityEvent $event)
    {
        Activity::create([
            'name'          => $event->name,
            'description'   => $event->description,
            'user_id'       => auth()->user()->id,
            'type'          => $event->type,
            'model_id'      => $event->model->id,
            'action'        => $event->route,
        ]);
    }
}
