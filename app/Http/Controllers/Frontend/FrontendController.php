<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CitizenSchedule;
use App\Models\Structure;
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

        // Получаем топ новости (они всегда показываются на главной, но не более 3)
        $featuredNews = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('is_featured', true)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(3)
            ->get();

        // Получаем остальные новости, исключая топ новости
        $limit = max(0, 3 - $featuredNews->count());
        $otherNews = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('is_featured', false)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit($limit)
            ->get();

        // Объединяем: сначала топ новости, затем остальные
        $news = $featuredNews->merge($otherNews);

        $news->each(function (News $item) {
            // Загружаем изображения с URL
            $item->load('images');
            $item->images->each(function ($image) {
                $image->image_url = route('storage.public', ['path' => $image->image]);
            });
            
            // Используем первое изображение из коллекции, если есть, иначе главное изображение
            if ($item->images->isNotEmpty()) {
                $item->image_url = $item->images->first()->image_url;
            } else {
                $item->image_url = $item->image
                    ? route('storage.public', ['path' => $item->image])
                    : null;
            }
        });

        $substations = Substation::query()
            ->withCount('employees')
            ->orderBy('id')
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

    public function newsList()
    {
        $news = News::query()
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->get()
            ->each(function (News $item) {
                // Загружаем изображения с URL
                $item->load('images');
                $item->images->each(function ($image) {
                    $image->image_url = route('storage.public', ['path' => $image->image]);
                });
                
                // Используем первое изображение из коллекции, если есть, иначе главное изображение
                if ($item->images->isNotEmpty()) {
                    $item->image_url = $item->images->first()->image_url;
                } else {
                    $item->image_url = $item->image
                        ? route('storage.public', ['path' => $item->image])
                        : null;
                }
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

        // Загружаем изображения с URL
        $news->load('images');
        $news->images->each(function ($image) {
            $image->image_url = route('storage.public', ['path' => $image->image]);
        });

        return view('frontend.news.detail', compact('news'));
    }
}

