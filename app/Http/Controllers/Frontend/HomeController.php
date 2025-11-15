<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
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
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(3)
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? route('storage.public', ['path' => $item->image])
                    : null;
            });

        return view('frontend.home', compact('images', 'news'));
    }
}

