<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    public function index()
    {
        $ad = Ad::getActive();
        return view('admin.ads.index', compact('ad'));
    }

    public function edit()
    {
        $ad = Ad::getActive();
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Delete old ad if exists
        $oldAd = Ad::getActive();
        if ($oldAd) {
            Storage::delete('public/' . $oldAd->image_path);
            $oldAd->delete();
        }

        // Store new image
        $imagePath = $request->file('image')
            ? $request->file('image')->store('ads', 'public')
            : ($oldAd ? $oldAd->image_path : null);

        Ad::create([
            'title' => $request->title,
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.ads.index')
            ->with('success', 'Advertisement updated successfully');
    }
}