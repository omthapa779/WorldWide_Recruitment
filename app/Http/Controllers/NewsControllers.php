<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsControllers extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(12);
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }
}