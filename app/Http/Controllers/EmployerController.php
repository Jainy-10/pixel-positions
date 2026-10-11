<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;


class EmployerController extends Controller
{
    /**
     * Companies / Employers listing page.
     * Handles both the normal page load and the "Load More" AJAX request
     * (same route + same paginator, just a different response format).
     */
    public function index(Request $request)
    {
        $employers = Employer::query()
            ->withCount('jobs as open_positions_count') // adjust relation name to match your schema
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->string('q') . '%');
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('employers.partials.employer-cards', compact('employers'))->render(),
                'next_page_url' => $employers->nextPageUrl(),
            ]);
        }

        return view('employers.index', compact('employers'));
    }

    public function create()
    {
        if (Auth::user()->role == 'employer') {
            return redirect('jobs/create');
        }

        return view('employers.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'string', 'max:300'],
            'url' => ['nullable', 'url'],
            'logo' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp']), 'dimensions:ratio=1'],
            'cover_picture' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp'])]
        ]);

        if ($request->has('cover_picture')) {
            $coverPath = $request->cover_picture->store('cover', 'public');
            $attributes['cover_picture'] = $coverPath;
        }

        $logoPath = $request->logo->store('logos', 'public');
        $attributes['logo'] = $logoPath;

        $user = Auth::user();

        $user->employer()->create($attributes);

        $user->forceFill([
            'role' => 'employer'
        ])->save();

        return redirect('/');
    }

    public function edit(Request $request)
    {
        if (! $request->user()->isEmployer()) {
            return redirect()->route('employers.create');
        }

        return view('employers.edit', [
            'employer' => $request->user()->employer
        ]);
    }



    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'string', 'max:300'],
            'logo' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp']), 'dimensions:ratio=1'],
            'cover_picture' => ['nullable', File::types(['jpeg', 'jpg', 'png', 'webp'])],
            'url' => ['nullable', 'url'],
        ]);

        $employer = $request->user()->employer;

        // Handle logo upload and cleanup
        if ($request->hasFile('logo')) {
            if ($employer->logo) {
                Storage::disk('public')->delete($employer->logo);
            }
            $attributes['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            unset($attributes['logo']);
        }

        // Handle cover picture upload and cleanup
        if ($request->hasFile('cover_picture')) {
            if ($employer->cover_picture) {
                Storage::disk('public')->delete($employer->cover_picture);
            }
            $attributes['cover_picture'] = $request->file('cover_picture')->store('covers', 'public');
        } else {
            unset($attributes['cover_picture']);
        }

        $employer->update($attributes);

        return redirect()->back()->with('success', 'Employer updated successfully.');
    }
}
