<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::latest('posted_on')->paginate(10);
        $featuredJobs = Job::getFeaturedJobs();
        return view('admin.jobs.index', compact('jobs', 'featuredJobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

      public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'positions_left' => 'required|integer|min:0',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'required|boolean'
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('jobs', 'public');
                
                Job::create([
                    'title' => $validated['title'],
                    'positions_left' => $validated['positions_left'],
                    'country' => $validated['country'],
                    'description' => $validated['description'],
                    'image_path' => $imagePath,
                    'is_featured' => (bool)$validated['is_featured'],
                    'posted_on' => now()
                ]);

                return redirect()
                    ->route('admin.jobs.index')
                    ->with('success', 'Job created successfully');
            }
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error creating job: ' . $e->getMessage()]);
        }
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'positions_left' => 'required|integer|min:0',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $job->image_path);
            $imagePath = $request->file('image')->store('jobs', 'public');
            $job->image_path = $imagePath;
        }

        $job->update([
            'title' => $request->title,
            'positions_left' => $request->positions_left,
            'country' => $request->country,
            'description' => $request->description,
            'is_featured' => $request->is_featured ?? false
        ]);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        Storage::delete('public/' . $job->image_path);
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}