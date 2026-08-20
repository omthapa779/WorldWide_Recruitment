<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Inertia\Inertia;
use Inertia\Response;

/**
 * The three static pages. All of their copy comes from the shared `site`
 * translations, so there is nothing to pass through as props.
 */
class PagesController extends Controller
{
    public function about(): Response
    {
        return Inertia::render('About', [
            'seo' => Seo::make(__('site.about.heroTitle'), __('site.about.meta')),
        ]);
    }

    public function services(): Response
    {
        return Inertia::render('Services', [
            'seo' => Seo::make(__('site.services.heroTitle'), __('site.services.meta')),
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Contact', [
            'seo' => Seo::make(__('site.contact.heroTitle'), __('site.contact.meta')),
        ]);
    }
}
