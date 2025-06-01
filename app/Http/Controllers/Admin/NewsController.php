<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('posted_on')->paginate(10);
        $recentNews = News::latest('posted_on')->take(4)->get();
        return view('admin.news.index', compact('news', 'recentNews'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cta' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'posted_on' => 'nullable|date'
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'cta' => $request->cta,
            'image_path' => $imagePath,
            'posted_on' => $request->posted_on ?? now()
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cta' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'posted_on' => 'nullable|date'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $news->image_path);
            $imagePath = $request->file('image')->store('news', 'public');
            $news->image_path = $imagePath;
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'cta' => $request->cta,
            'posted_on' => $request->posted_on ?? $news->posted_on
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        Storage::delete('public/' . $news->image_path);
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully');
    }
}