<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MissionOfEmergencyService;
use Illuminate\Support\Facades\Storage;

class MissionOfEmergencyServiceController extends Controller
{
    /**
     * Показать страницу миссии скорой помощи
     */
    public function show()
    {
        $missions = MissionOfEmergencyService::query()
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($mission) {
                if ($mission->image) {
                    $mission->image_url = Storage::disk('public')->url($mission->image);
                } else {
                    $mission->image_url = null;
                }
                return $mission;
            });

        return view('frontend.mission-of-emergency-service.show', compact('missions'));
    }
}
