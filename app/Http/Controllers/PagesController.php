<?php

namespace App\Http\Controllers;

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
        return Inertia::render('About');
    }

    public function services(): Response
    {
        return Inertia::render('Services');
    }

    public function contact(): Response
    {
        return Inertia::render('Contact');
    }
}
