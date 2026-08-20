<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Support\Seo;
use App\Support\SiteContent;
use Inertia\Inertia;
use Inertia\Response;

class NewsControllers extends Controller
{
    public function index(): Response
    {
        $news = News::where('status', 'published')
            ->latest('posted_on')
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('News/Index', [
            'news' => $news->through(fn (News $item) => SiteContent::newsCard($item)),
            'seo' => Seo::make(__('site.news.heroTitle'), __('site.news.meta')),
        ]);
    }

    public function show(int|string $id): Response
    {
        $news = News::findOrFail($id);

        return Inertia::render('News/Show', [
            'article' => array_merge(SiteContent::newsCard($news), [
                'content' => $news->localised('content'),
                'images' => collect([$news->image_1, $news->image_2])
                    ->filter()
                    ->map(fn ($path) => asset('storage/'.$path))
                    ->values(),
            ]),
            'seo' => Seo::make(
                $news->localised('title'),
                $news->localised('content'),
                ($img = $news->image_1 ?: $news->image_2) ? asset('storage/'.$img) : null,
                'article',
            ),
            'more' => News::where('status', 'published')
                ->where('id', '!=', $news->id)
                ->latest('posted_on')
                ->take(4)
                ->get()
                ->map(fn (News $item) => SiteContent::newsCard($item))
                ->values(),
        ]);
    }
}
