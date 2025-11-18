<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CitizenSchedule;
use App\Models\Structure;
use App\Models\MissionValue;
use App\Models\EthicalCode;
use App\Models\IncomeExpenseReport;
use App\Models\Vacancy;
use App\Models\MedicalEmploymentInfo;
use App\Models\CorporateDocument;
use App\Models\ActivitySphere;
use App\Models\SsmpStructure;
use App\Models\ProcurementPlan;
use App\Models\AnnouncementCategory;
use App\Models\Protocol;
use App\Models\MedicalHelpForForeigners;
use App\Models\LegalFramework;
use App\Models\EmergencyServiceRules;
use App\Models\SocialInsurance;
use App\Models\RubricForPopulation;
use App\Models\StateServices;
use App\Models\RegistryOfStateServices;
use App\Models\StateServiceStandards;
use App\Models\StateServiceRegulations;
use App\Models\StateFlag;
use App\Models\StateEmblem;
use App\Models\StateAnthem;
use App\Models\PaidService;
use App\Models\ComplianceOfficerPlan;
use App\Models\InternalCorruptionRiskAnalysis;
use App\Models\InternalRegulations;
use App\Models\CorruptionRiskPosition;
use App\Models\CorruptionRiskList;
use App\Models\CorruptionRiskMap;
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

    public function vacancyEmployment()
    {
        $vacancies = Vacancy::query()
            ->orderByDesc('created_at')
            ->get();

        $employmentInfos = MedicalEmploymentInfo::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (MedicalEmploymentInfo $item) {
                $item->file1_url = $item->file1
                    ? route('storage.public', ['path' => $item->file1])
                    : null;
                $item->file2_url = $item->file2
                    ? route('storage.public', ['path' => $item->file2])
                    : null;
                $item->file3_url = $item->file3
                    ? route('storage.public', ['path' => $item->file3])
                    : null;
            });

        return view('frontend.about.vacancy-employment', compact('vacancies', 'employmentInfos'));
    }

    public function documents()
    {
        $categories = CorporateDocument::query()
            ->with('documents')
            ->orderBy('title')
            ->get()
            ->each(function (CorporateDocument $category) {
                $category->documents->each(function ($document) {
                    $document->file_url = $document->file_path
                        ? Storage::disk('public')->url($document->file_path)
                        : null;
                });
            });

        return view('frontend.about.documents', compact('categories'));
    }

    public function activitySphere()
    {
        $activitySphere = ActivitySphere::query()
            ->orderByDesc('created_at')
            ->first();

        $ssmpStructures = SsmpStructure::query()
            ->orderBy('order')
            ->orderBy('substation_number')
            ->get();

        return view('frontend.about.activity-sphere', compact('activitySphere', 'ssmpStructures'));
    }

    public function procurementPlan()
    {
        $plans = ProcurementPlan::query()
            ->orderByDesc('year')
            ->get()
            ->each(function (ProcurementPlan $plan) {
                $plan->file_url = $plan->file_path
                    ? Storage::disk('public')->url($plan->file_path)
                    : null;
            });

        return view('frontend.about.procurement-plan', compact('plans'));
    }

    public function announcements()
    {
        $categories = AnnouncementCategory::query()
            ->with('announcements')
            ->orderBy('title')
            ->get()
            ->each(function (AnnouncementCategory $category) {
                $category->announcements->each(function ($announcement) {
                    $announcement->file_url = $announcement->file_path
                        ? Storage::disk('public')->url($announcement->file_path)
                        : null;
                });
            });

        return view('frontend.about.announcements', compact('categories'));
    }

    public function protocols()
    {
        $protocolsByYear = Protocol::query()
            ->orderByDesc('year')
            ->orderBy('title')
            ->get()
            ->each(function (Protocol $protocol) {
                $protocol->file_url = $protocol->file_path
                    ? Storage::disk('public')->url($protocol->file_path)
                    : null;
            })
            ->groupBy('year');

        return view('frontend.about.protocols', compact('protocolsByYear'));
    }

    public function medicalHelpForForeigners()
    {
        $items = MedicalHelpForForeigners::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.medical-help-for-foreigners', compact('items'));
    }

    public function legalFramework()
    {
        $items = LegalFramework::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.legal-framework', compact('items'));
    }

    public function emergencyServiceRules()
    {
        $items = EmergencyServiceRules::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.emergency-service-rules', compact('items'));
    }

    public function socialInsurance()
    {
        $items = SocialInsurance::query()
            ->orderBy('order')
            ->orderBy('created_at')
            ->get()
            ->each(function (SocialInsurance $item) {
                if ($item->image) {
                    $item->image_url = Storage::disk('public')->url($item->image);
                }
                if ($item->type === 'video' && $item->content) {
                    $item->embed_url = $this->convertYoutubeUrlToEmbed($item->content);
                }
            });

        return view('frontend.about.social-insurance', compact('items'));
    }

    public function rubricForPopulation()
    {
        $items = RubricForPopulation::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (RubricForPopulation $item) {
                $item->image_url = $item->image
                    ? Storage::disk('public')->url($item->image)
                    : null;
            });

        return view('frontend.about.rubric-for-population', compact('items'));
    }

    public function rubricForPopulationDetail($id)
    {
        $item = RubricForPopulation::findOrFail($id);

        $item->image_url = $item->image
            ? Storage::disk('public')->url($item->image)
            : null;

        $item->file_url = $item->file_path
            ? Storage::disk('public')->url($item->file_path)
            : null;

        if ($item->images && is_array($item->images)) {
            $item->images_urls = array_map(function ($image) {
                return Storage::disk('public')->url($image);
            }, $item->images);
        } else {
            $item->images_urls = [];
        }

        if ($item->type === 'video' && $item->content) {
            $item->embed_url = $this->convertYoutubeUrlToEmbed($item->content);
        }

        return view('frontend.about.rubric-for-population-detail', compact('item'));
    }

    /**
     * Преобразует URL YouTube в embed формат
     */
    private function convertYoutubeUrlToEmbed(string $url): ?string
    {
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $url;
        }
        
        return null;
    }

    public function stateServices()
    {
        $items = StateServices::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.state-services', compact('items'));
    }

    public function registryOfStateServices()
    {
        $items = RegistryOfStateServices::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.registry-of-state-services', compact('items'));
    }

    public function stateServiceStandards()
    {
        $items = StateServiceStandards::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.state-service-standards', compact('items'));
    }

    public function stateServiceRegulations()
    {
        $items = StateServiceRegulations::query()
            ->orderBy('created_at')
            ->get();

        return view('frontend.about.state-service-regulations', compact('items'));
    }

    public function stateFlag()
    {
        $item = StateFlag::query()->first();
        
        if ($item && $item->image) {
            $item->image_url = Storage::disk('public')->url($item->image);
        }

        return view('frontend.about.state-flag', compact('item'));
    }

    public function stateEmblem()
    {
        $item = StateEmblem::query()->first();
        
        if ($item && $item->image) {
            $item->image_url = Storage::disk('public')->url($item->image);
        }

        return view('frontend.about.state-emblem', compact('item'));
    }

    public function stateAnthem()
    {
        $item = StateAnthem::query()->first();
        
        if ($item) {
            if ($item->image) {
                $item->image_url = Storage::disk('public')->url($item->image);
            }
            if ($item->audio_file) {
                $item->audio_url = Storage::disk('public')->url($item->audio_file);
            }
        }

        return view('frontend.about.state-anthem', compact('item'));
    }

    public function paidServices()
    {
        $services = PaidService::query()
            ->with('items')
            ->orderByDesc('created_at')
            ->get()
            ->each(function (PaidService $service) {
                $service->file_url = $service->file
                    ? Storage::disk('public')->url($service->file)
                    : null;
            });

        return view('frontend.about.paid-services', compact('services'));
    }

    public function complianceOfficerPlan()
    {
        $plans = ComplianceOfficerPlan::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (ComplianceOfficerPlan $plan) {
                $plan->file_url = $plan->file_path
                    ? Storage::disk('public')->url($plan->file_path)
                    : null;
            });

        return view('frontend.about.compliance-officer-plan', compact('plans'));
    }

    public function corruptionRiskAnalysis()
    {
        $analyses = InternalCorruptionRiskAnalysis::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (InternalCorruptionRiskAnalysis $analysis) {
                $analysis->file_url = $analysis->file_path
                    ? Storage::disk('public')->url($analysis->file_path)
                    : null;
            });

        return view('frontend.about.corruption-risk-analysis', compact('analyses'));
    }

    public function internalRegulations()
    {
        $regulations = InternalRegulations::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (InternalRegulations $regulation) {
                $regulation->file_url = $regulation->file_path
                    ? Storage::disk('public')->url($regulation->file_path)
                    : null;
            });

        return view('frontend.about.internal-regulations', compact('regulations'));
    }

    public function corruptionRiskPositions()
    {
        $positions = CorruptionRiskPosition::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (CorruptionRiskPosition $position) {
                $position->file_url = $position->file_path
                    ? Storage::disk('public')->url($position->file_path)
                    : null;
            });

        return view('frontend.about.corruption-risk-positions', compact('positions'));
    }

    public function corruptionRiskList()
    {
        $lists = CorruptionRiskList::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (CorruptionRiskList $list) {
                $list->file_url = $list->file_path
                    ? Storage::disk('public')->url($list->file_path)
                    : null;
            });

        return view('frontend.about.corruption-risk-list', compact('lists'));
    }

    public function corruptionRiskMap()
    {
        $maps = CorruptionRiskMap::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (CorruptionRiskMap $map) {
                $map->file_url = $map->file_path
                    ? Storage::disk('public')->url($map->file_path)
                    : null;
            });

        return view('frontend.about.corruption-risk-map', compact('maps'));
    }
}

