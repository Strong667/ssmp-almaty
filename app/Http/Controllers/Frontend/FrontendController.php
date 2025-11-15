<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CitizenSchedule;
use App\Models\Structure;
use App\Models\MissionValue;
use App\Models\News;
use App\Models\Setting;
use App\Models\Substation;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function home()
    {
        $images = Setting::query()
            ->whereNotNull('main_image')
            ->orderByDesc('updated_at')
            ->get()
            ->map(fn (Setting $setting) => [
                'id' => $setting->id,
                'url' => route('storage.public', ['path' => $setting->main_image]),
            ]);

        $news = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(3)
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? route('storage.public', ['path' => $item->image])
                    : null;
            });

        $substations = Substation::query()
            ->withCount('employees')
            ->orderBy('name')
            ->get();

        return view('frontend.home', compact('images', 'news', 'substations'));
    }

    public function administration()
    {
        $admins = Admin::query()
            ->orderBy('full_name')
            ->get()
            ->each(function (Admin $admin) {
                $admin->image_url = $admin->image
                    ? route('storage.public', ['path' => $admin->image])
                    : null;
            });

        return view('frontend.about.administration', compact('admins'));
    }

    public function schedule()
    {
        $schedules = CitizenSchedule::query()
            ->orderBy('day')
            ->orderBy('time')
            ->get();

        return view('frontend.about.schedule', compact('schedules'));
    }

    public function structure()
    {
        $structures = Structure::query()
            ->orderBy('title')
            ->get()
            ->each(function (Structure $structure) {
                $structure->image_url = $structure->image
                    ? route('storage.public', ['path' => $structure->image])
                    : null;
            });

        return view('frontend.about.structure', compact('structures'));
    }

    public function mission()
    {
        $missionValues = MissionValue::query()
            ->orderBy('title')
            ->get();

        return view('frontend.about.mission', compact('missionValues'));
    }

    public function newsList()
    {
        $news = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? route('storage.public', ['path' => $item->image])
                    : null;
            });

        return view('frontend.news.list', compact('news'));
    }

    public function newsDetail(string $slug)
    {
        $news = News::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $news->image_url = $news->image
            ? route('storage.public', ['path' => $news->image])
            : null;

        return view('frontend.news.detail', compact('news'));
    }
}

