<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Auth;


class SavedJobController extends Controller
{
    public function index()
    {
        $savedJobs = Auth::user()->savedJobs()->latest()->get();

        return view("result", [
            'heading' => "Saved Jobs",
            'jobs' => $savedJobs
        ]);
    }

    public function toggle(Job $job)
    {
        $user = Auth::user();

        $user->savedJobs()->toggle($job->id);

        return back()->with('success', 'Your save job list has been updated');
    }
}
