<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Hero;
use App\Models\Job;
use App\Models\News;
use App\Support\SiteContent;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $hero = Hero::getActive();
        $ad = Ad::getActive();

        return Inertia::render('Home', [
            'hero' => [
                'title' => $hero?->localised('title')
                    ?? __('site.home.sub'),
                'cta' => $hero?->localised('button_cta')
                    ?? __('site.common.contactUs'),
                'image' => $hero && $hero->image_path
                    ? asset('storage/'.$hero->image_path)
                    : asset('resources/images/hero_japan.jpg'),
            ],
            // The hero cross-fades through these. The admin-managed hero image
            // always leads; the rest are site assets making up the reel.
            'heroSlides' => array_values(array_unique([
                $hero && $hero->image_path
                    ? asset('storage/'.$hero->image_path)
                    : asset('resources/images/hero_japan.jpg'),
                asset('resources/images/services/overseas_recruitment.jpg'),
                asset('resources/images/services/deployment.jpg'),
                asset('resources/images/why_us.jpg'),
            ])),
            'ad' => [
                'title' => $ad->title ?? 'WorldWide Recruitment Services',
                'image' => $ad && $ad->image_path
                    ? asset('storage/'.$ad->image_path)
                    : asset('resources/images/test_ad.png'),
            ],
            'featuredJobs' => Job::getFeaturedJobs(5)
                ->map(fn (Job $job) => SiteContent::jobCard($job))
                ->values(),
            'latestNews' => News::where('status', 'published')
                ->latest('posted_on')
                ->take(4)
                ->get()
                ->map(fn (News $item) => SiteContent::newsCard($item))
                ->values(),
        ]);
    }
}
