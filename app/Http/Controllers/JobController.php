<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Employer;
use App\Models\Tag;
use Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $jobs = Job::query()->latest()->with(['employer', 'tags'])->get()->groupBy('featured');
     
        $featuredJobs = Job::query()->latest()->with(['employer', 'tags'])->where('featured', 1)->take(6)->get();
        $jobs = Job::query()->latest()->with(['employer'])->where('featured', 0)->take(6)->get();

        return view('jobs.index', [
            'featuredJobs' => $featuredJobs,
            'jobs' => $jobs,
            'tags' => Tag::take(17)->get(),
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        if (! Gate::allows('create-job')) {
            return redirect('employer/create');
        }


        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $attributes = $request->validated();
        
        $attributes['slug'] = Str::slug($attributes['title']);
        
        // $attributes['featured'] = $request->has('featured'); 
        $attributes['featured']  = $request->boolean('featured');        

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if ($attributes['tags']) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag); 
            }
        }

        return redirect('/')->with('success', 'Your Job has been posted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job, string $slug)
    {        
        if ($job->slug != $slug) {
            return redirect()->route('jobs.show', ['id' => $job->id, 'slug' => $job->slug], 301);
        }

        $responsibilities = array_filter(explode("\n", str_replace("\r", '', $job->responsibilities)));
        $requirements = array_filter(explode("\n", str_replace("\r", '', $job->requirements)));
        
        $similarJobs = Job::where('id', '!=', $job->id)
            ->whereHas('tags', function ($query) use ($job) {
                $query->whereIn('tags.id', $job->tags->pluck('id'));
            })
            ->withCount(['tags' => function ($query) use ($job) {
                $query->whereIn('tags.id', $job->tags->pluck('id'));
            }])
            ->orderByDesc('tags_count') // Prioritizes jobs with the most matching tags
            ->take(3)
            ->get();

        return view('jobs.show', [
            'job' => $job,
            'responsibilities' => $responsibilities,
            'requirements' => $requirements,
            'similarJobs' => $similarJobs
        ]);

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {

        if (Auth::user()->cannot('edit-job', $job)) {
            abort(403);
        }

        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $tagsArray = explode(",", $request->tags);

        $tagIds = collect($tagsArray)->map(function ($name) {
            return Tag::firstOrCreate(['name' => trim($name)])->id;
        });

        $job->tags()->sync($tagIds);

        $attributes = $request->safe();

        $job->forceFill($attributes->except('tags'))->save();

        return redirect("jobs/{$job->id}/{$job->slug}")->with('success', 'Your job has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if (Auth::user()->employer->id !== $job->employer_id) {
            return redirect('/');
        }

        $job->delete();

        return redirect('/')->with('success', 'The job has been deleted');
    }

    public function jobResults(Employer $employer)
    {
        $jobs = $employer->jobs()->with('tags')->get();

        return view('result', [
            'jobs' => $jobs,
            'heading' => $employer->name
        ]);
    }
}
