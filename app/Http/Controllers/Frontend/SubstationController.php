<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Substation;
use App\Models\SubstationEmployee;
use Illuminate\Support\Facades\Storage;

class SubstationController extends Controller
{
    /**
     * Показать все подстанции на главной странице
     */
    public function index()
    {
        $substations = Substation::query()
            ->withCount('employees')
            ->orderBy('name')
            ->get();

        return view('frontend.substations.index', compact('substations'));
    }

    /**
     * Показать сотрудников конкретной подстанции
     */
    public function show($id)
    {
        $substation = Substation::with('employees')->findOrFail($id);
        
        $employees = $substation->employees()
            ->orderBy('id')
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'full_name' => $employee->full_name,
                    'position' => $employee->position,
                    'description' => $employee->description,
                    'photo_url' => $employee->photo 
                        ? Storage::disk('public')->url($employee->photo) 
                        : null,
                ];
            });

        return view('frontend.substations.show', [
            'substation' => $substation,
            'employees' => $employees,
        ]);
    }
}
