<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\News;
use Illuminate\Http\Response;

/**
 * XML sitemap covering every publicly reachable URL.
 *
 * Generated on request rather than written to disk so newly published jobs
 * and articles appear without anyone remembering to regenerate a file.
 */
class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            ['loc' => route('home'), 'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => route('about'), 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('services'), 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('jobs.index'), 'priority' => '0.9', 'freq' => 'daily'],
            ['loc' => route('news.index'), 'priority' => '0.7', 'freq' => 'weekly'],
            ['loc' => route('contact'), 'priority' => '0.6', 'freq' => 'monthly'],
        ];

        foreach (Job::latest('posted_on')->get() as $job) {
            $urls[] = [
                'loc' => route('jobs.show', $job->id),
                'lastmod' => optional($job->updated_at)->toAtomString(),
                'priority' => '0.8',
                'freq' => 'weekly',
            ];
        }

        foreach (News::where('status', 'published')->latest('posted_on')->get() as $item) {
            $urls[] = [
                'loc' => route('news.read', $item->id),
                'lastmod' => optional($item->updated_at)->toAtomString(),
                'priority' => '0.6',
                'freq' => 'monthly',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
