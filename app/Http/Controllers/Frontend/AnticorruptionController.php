<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Anticorruption;
use Illuminate\Support\Facades\Storage;

class AnticorruptionController extends Controller
{
    /**
     * Показать страницу антикоррупции
     */
    public function show()
    {
        $anticorruption = Anticorruption::query()
            ->with('images')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($anticorruption) {
            $anticorruption->images->each(function ($image) {
                $image->image_url = Storage::disk('public')->url($image->image);
            });
            
            // Получаем изображение для заголовка
            $headerImage = $anticorruption->images->where('is_header', true)->first();
            if ($headerImage) {
                $anticorruption->headerImage = $headerImage;
            } else {
                $anticorruption->headerImage = null;
            }
        }

        return view('frontend.anticorruption.show', compact('anticorruption'));
    }
}
