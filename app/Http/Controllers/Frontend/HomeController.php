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
                'url' => Storage::disk('public')->url($setting->main_image),
            ]);

        $news = News::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->each(function (News $item) {
                $item->image_url = $item->image
                    ? Storage::disk('public')->url($item->image)
                    : null;
            });

        return view('frontend.home', compact('images', 'news'));
    }
}

