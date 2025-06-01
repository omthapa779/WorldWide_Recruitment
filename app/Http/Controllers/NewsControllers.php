<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsControllers extends Controller
{
    public function index()
    {
        $news = News::latest('posted_on')->paginate(12);
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        $relatedNews = News::where('id', '!=', $news->id)
            ->latest('posted_on')
            ->take(3)
            ->get();
            
        return view('news.show', compact('news', 'relatedNews'));
    }
}