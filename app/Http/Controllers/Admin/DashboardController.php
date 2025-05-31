<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\News;
use App\Models\Ad;
use App\Models\Hero;

class DashboardController extends Controller
{
    public function index()
    {
        $statistics = [
            'totalJobs' => Job::count(),
            'totalNews' => News::count(),
            'activeAds' => Ad::where('active', true)->count(),
            'heroSections' => Hero::count(),
        ];

        return view('admin.dashboard.index', compact('statistics'));
    }
}