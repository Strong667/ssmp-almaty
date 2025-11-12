<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CitizenSchedule;
use App\Models\Structure;
use App\Models\MissionValue;

class AboutController extends Controller
{
    public function administration()
    {
        $admins = Admin::query()
            ->orderBy('full_name')
            ->get();

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
            ->get();

        return view('frontend.about.structure', compact('structures'));
    }

    public function mission()
    {
        $missionValues = MissionValue::query()
            ->orderBy('title')
            ->get();

        return view('frontend.about.mission', compact('missionValues'));
    }
}

