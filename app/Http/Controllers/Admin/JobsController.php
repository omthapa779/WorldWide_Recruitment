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
            'is_featured' => 'required|boolean',
            'featured_order' => 'nullable|integer|min:1|required_if:is_featured,1',
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
                    'featured_order' => $validated['is_featured'] ? $validated['featured_order'] : null,
                    'posted_on' => now(),
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'positions_left' => 'required|integer|min:0',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'required|boolean',
            'featured_order' => 'nullable|integer|min:1|required_if:is_featured,1',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if needed
            if ($job->image_path) {
                Storage::disk('public')->delete($job->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('jobs', 'public');
        }

        $validated['is_featured'] = (bool)$validated['is_featured'];
        $validated['featured_order'] = $validated['is_featured'] ? $validated['featured_order'] : null;

        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        if ($job->image_path) {
            Storage::disk('public')->delete($job->image_path);
        }
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job  deleted successfully');
    }
}