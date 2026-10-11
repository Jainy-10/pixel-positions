<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getApplicationsQuery(Request $request)
    {
        $user = $request->user();

        if (! $user->isEmployer()) {
            abort(403);
        }

        $employer = $user->employer;

        return Application::whereHas('job', function ($q) use ($employer) {
            $q->where('employer_id', $employer->id);
        });
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if (! $user->isEmployer()) {
            abort(403);
        }

        $stats = [];

        $employer = $user->employer;
        $activePosts = $employer->jobs()->count();

        $jobsThisMonth = $employer->jobs()
            ->whereBetween('created_at',  [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->count();

        $stats[] = [
            'label' => 'Active Posts',
            'value' => $activePosts,
            'icon' => 'work',
            'trend' => "+{$jobsThisMonth} this month",
            'trend_icon' => 'trending_up',
        ];

        $applicationsQuery =  $this->getApplicationsQuery($request);

        $totalApplications = (clone $applicationsQuery)->count();

        $applicationsThisMonth = (clone $applicationsQuery) 
            ->whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->count();

        $applicationsThisMonth;
        
        $stats[] = [
            'label' => 'Total Applications',
            'value' => $totalApplications,
            'icon' => 'description',
            'trend' => "+{$applicationsThisMonth} this month",
            'trend_icon' => 'trending_up',
        ];

        $totalInterviews = (clone $applicationsQuery)->whereNotNull('interview_at')
            ->count();

        $interviewsToday = (clone $applicationsQuery)->whereDate('interview_at', today())
            ->count();

        $stats[] = [
                'label' => 'Interviews Scheduled',
                'value' => $totalInterviews,
                'icon' => 'calendar_month',
                'trend' =>  "{$interviewsToday} today",
                'trend_icon' => 'schedule',
        ];

        $applications = (clone $applicationsQuery)->with(['candidate', 'job'])->latest()->limit(3)->get();

        return view('employers.dashboard', [
            'stats' => $stats,
            'applications' => $applications
        ]);
    }

    public function candidates(Request $request)
    {
        $user = $request->user();

        if (! $user->isEmployer()) {
            abort(404);
        }

        $applicationsQuery  = $this->getApplicationsQuery($request);

        return view('employers.candidates', [
            'applications' => $applicationsQuery->latest()->get()
        ]);
    }
}
