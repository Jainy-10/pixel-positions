<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isEmployer()) {
            abort(403);
        }

        $applications = Application::where('user_id', $request->user()->id)->get();
        
        return view('candidate.applications.index', [
            'applications' => $applications
        ]);
    }
    
    public function create(Job $job)
    {
        return view('jobs.apply', [
            'job' => $job
        ]);
    }

    public function store(Request $request, Job $job)
    {
        $request->validate([
            'resume' => [
                'required', 
                'file',  
                'mimes:pdf,docx,jpg,jpeg,png,webp', 
                'max:5120'
            ]
        ]);

        if ($request->user()->isEmployer()) {
            return back()->with('error', 'Employers cannot apply for a job. Switch to your applicant account');
        }
        
        $alreadyApplied = Application::where('job_id', $job->id)
            ->where('user_id', $request->user()->id)
            ->exists();
        
        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job. Track your appliation');
        }

        $originalName = $request->file('resume')->getClientOriginalName();
        $resumePath = $request->file('resume')->store('resume',  'local');

        $job->applications()->create([
            'user_id' => $request->user()->id,
            'resume' => $resumePath,
            'resume_original_name' => $originalName,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending'
        ]);

        return redirect()->route('jobs.show', ['job' => $job->id, 'slug' => $job->slug])
            ->with('success', 'Application submitted successfully');        
    }

    public function showForEmployer(Request $request, Application $application)
    {
        $application->load(['job', 'candidate']);
        Gate::authorize('view-application', $application);

        return view('application',  [
            'application' => $application
        ]);
    }

    public function showForCandidate(Request $request, Application $application)
    {
        $application->load(['job', 'candidate']);
        
        if ($application->candidate()->isNot($request->user())
                || $request->user()->isEmployer()) {
            abort(403);
        }

        return view('candidate.applications.show', [
            'application' => $application
        ]);
    }

    public function resume(Application $application)
    {
        abort_unless(
            Storage::disk('local')->exists($application->resume),
            404
        );

        return Storage::disk('local')->response($application->resume);
    }

    public function instructions(Request $request, Application $application)
    {
        $validator = Validator::make($request->all(), [
            'instructions' => ['required',  'min:2'],
            'interview_at' => [Rule::requiredIf($request->action === 'interview')]
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please enter valid input.');
        }

        $validatedData = $validator->validated();
        $validatedData['status'] = $request->input('action');
        
        $application->update($validatedData);

        return back()->with('success', 'Your response has been sent to the applicant');
    }

    public function redirectToGmail(string $to)
    {
        $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . 
            urlencode($to);

        return redirect()->away($gmailUrl);
    }
}
