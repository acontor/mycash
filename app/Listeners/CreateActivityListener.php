<?php

namespace App\Listeners;

use App\Events\CreateActivityEvent;
use App\Models\Activity;

class CreateActivityListener
{
    /**
     * Handle the event.
     *
     * @param CreateActivityEvent $event
     *
     * @return void
     */
    public function handle(CreateActivityEvent $event): void
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
