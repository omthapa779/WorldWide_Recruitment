<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::getActive();
        return view('admin.hero.index', compact('hero'));
    }

    public function edit()
    {
        $hero = Hero::getActive();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_cta' => 'required|string|max:50',
            'image' => $request->hasFile('image') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : ''
        ]);

        $oldHero = Hero::getActive();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($oldHero && Storage::disk('public')->exists($oldHero->image_path)) {
                Storage::disk('public')->delete($oldHero->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('hero', 'public');
        } else {
            $imagePath = $oldHero ? $oldHero->image_path : null;
        }

        // Delete old hero
        if ($oldHero) {
            $oldHero->delete();
        }

        // Create new hero
        Hero::create([
            'title' => $request->title,
            'button_cta' => $request->button_cta,
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Hero section updated successfully');
    }
}