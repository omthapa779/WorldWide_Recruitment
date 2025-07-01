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
        // Show all news (draft and published) for admin
        $news = News::latest('posted_on')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'posted_on' => 'nullable|date',
        ]);

        $status = $request->input('action') === 'publish' ? 'published' : 'draft';

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'posted_on' => $validated['posted_on'] ?? now(),
            'status' => $status,
        ];

        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store('news', 'public');
        }
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', $status === 'published' ? 'News published!' : 'Draft saved!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'posted_on' => 'nullable|date',
        ]);

        $status = $request->input('action') === 'publish' ? 'published' : 'draft';

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'posted_on' => $validated['posted_on'] ?? now(),
            'status' => $status,
        ];

        if ($request->hasFile('image_1')) {
            if ($news->image_1) Storage::disk('public')->delete($news->image_1);
            $data['image_1'] = $request->file('image_1')->store('news', 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($news->image_2) Storage::disk('public')->delete($news->image_2);
            $data['image_2'] = $request->file('image_2')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', $status === 'published' ? 'News updated and published!' : 'Draft updated!');
    }

    public function destroy(News $news)
    {
        if ($news->image_1) Storage::disk('public')->delete($news->image_1);
        if ($news->image_2) Storage::disk('public')->delete($news->image_2);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted.');
    }
}