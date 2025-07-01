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
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
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
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'posted_on' => 'required|date'
        ]);

        $data = $request->only(['title', 'content', 'posted_on']);

        // Handle Image 1
        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store('news', 'public');
        }

        // Handle Image 2
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store('news', 'public');
        }

        $news = News::create($data);

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
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'posted_on' => 'required|date'
        ]);

        $data = $request->only(['title', 'content', 'posted_on']);

        // Handle Image 1
        if ($request->hasFile('image_1')) {
            if ($news->image_1) {
                Storage::disk('public')->delete($news->image_1);
            }
            $data['image_1'] = $request->file('image_1')->store('news', 'public');
        }

        // Handle Image 2
        if ($request->hasFile('image_2')) {
            if ($news->image_2) {
                Storage::disk('public')->delete($news->image_2);
            }
            $data['image_2'] = $request->file('image_2')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        // Extract image paths from content and delete them
        preg_match_all('/<img[^>]+src="([^">]+)"/', $news->content, $matches);
        foreach ($matches[1] as $src) {
            $path = str_replace(asset('storage/'), '', $src);
            Storage::disk('public')->delete($path);
        }
        
        $news->delete();
        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully');
    }
}