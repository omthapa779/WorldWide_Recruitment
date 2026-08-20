<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Support\Seo;
use App\Support\SiteContent;
use Inertia\Inertia;
use Inertia\Response;

class JobController extends Controller
{
    public function index(): Response
    {
        $jobs = Job::latest('posted_on')->paginate(9)->withQueryString();

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs->through(fn (Job $job) => SiteContent::jobCard($job)),
            'seo' => Seo::make(__('site.jobs.heroTitle'), __('site.jobs.meta')),
            'countries' => Job::query()
                ->whereNotNull('country')
                ->distinct()
                ->orderBy('country')
                ->pluck('country'),
        ]);
    }

    public function show(Job $job): Response
    {
        return Inertia::render('Jobs/Show', [
            'job' => array_merge(SiteContent::jobCard($job), [
                'description' => $job->localised('description'),
            ]),
            'seo' => Seo::make(
                $job->localised('title'),
                $job->localised('description'),
                $job->image_path ? asset('storage/'.$job->image_path) : null,
                'article',
            ),
            'related' => Job::where('id', '!=', $job->id)
                ->latest('posted_on')
                ->take(3)
                ->get()
                ->map(fn (Job $item) => SiteContent::jobCard($item))
                ->values(),
        ]);
    }
}
