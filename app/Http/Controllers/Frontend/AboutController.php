<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CitizenSchedule;
use App\Models\Structure;
use App\Models\MissionValue;
use App\Models\EthicalCode;
use App\Models\IncomeExpenseReport;
use Illuminate\Support\Facades\Storage;

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

    public function ethicalCode()
    {
        $ethicalCodes = EthicalCode::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (EthicalCode $item) {
                $item->pdf_url = $item->pdf_path
                    ? Storage::disk('public')->url($item->pdf_path)
                    : null;
            });

        return view('frontend.about.ethical-code', compact('ethicalCodes'));
    }

    public function incomeExpense()
    {
        $reports = IncomeExpenseReport::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (IncomeExpenseReport $item) {
                $item->file_url = $item->file_path
                    ? Storage::disk('public')->url($item->file_path)
                    : null;
            });

        return view('frontend.about.income-expense', compact('reports'));
    }
}

