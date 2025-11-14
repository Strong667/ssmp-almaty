<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HealthyLifestyle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class HealthyLifestyleController extends Controller
{
    /**
     * Показать страницу ЗОЖ
     */
    public function show()
    {
        $locale = App::getLocale();
        $imageField = $locale === 'kk' ? 'image_kk' : 'image_ru';

        $images = HealthyLifestyle::query()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) use ($imageField) {
                if ($item->$imageField) {
                    $item->image_url = Storage::disk('public')->url($item->$imageField);
                } else {
                    $item->image_url = null;
                }
                return $item;
            })
            ->filter(function ($item) {
                return $item->image_url !== null;
            })
            ->values();

        return view('frontend.healthy-lifestyle.show', compact('images'));
    }
}
