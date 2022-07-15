<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Activity::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('notifications.index', compact('notifications'));
    }
}
