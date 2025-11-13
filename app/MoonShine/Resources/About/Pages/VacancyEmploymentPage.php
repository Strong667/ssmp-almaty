<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\Vacancy;
use App\Models\MedicalEmploymentInfo;
use Illuminate\Support\Facades\Storage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\FlexibleRender;

#[SkipMenu]
class VacancyEmploymentPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Вакансия';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/vacancy-employment' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $vacancies = Vacancy::query()
            ->orderByDesc('created_at')
            ->get();

        $employmentInfos = MedicalEmploymentInfo::query()
            ->orderByDesc('created_at')
            ->get()
            ->each(function (MedicalEmploymentInfo $item) {
                $item->attachment_url = $item->attachment
                    ? Storage::disk('public')->url($item->attachment)
                    : null;
            });

        $containerComponents = [];

        // Секция информации для медицинских специалистов (сначала, в формате show как в админ-панели)
        if ($employmentInfos->isNotEmpty()) {
            foreach ($employmentInfos as $info) {
                // Создаем поля в формате show как в админ-панели
                $employmentFields = [
                    ID::make()->fillData(['id' => $info->id], 0),
                    Text::make('Заголовок', 'title')
                        ->fillData(['title' => $info->title], 0)
                        ->readonly(),
                    Textarea::make('Описание', 'description')
                        ->fillData(['description' => $info->description], 0)
                        ->readonly(),
                ];

                if ($info->attachment) {
                    $employmentFields[] = File::make('Прикрепленный файл', 'attachment')
                        ->disk('public')
                        ->fillData(['attachment' => $info->attachment], 0)
                        ->readonly();
                }

                $containerComponents[] = Box::make($info->title, $employmentFields);
            }
        } else {
            $containerComponents[] = Box::make('Информация для медицинских специалистов', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        // Секция вакансий (снизу, в формате show как в админ-панели)
        if ($vacancies->isNotEmpty()) {
            foreach ($vacancies as $vacancy) {
                // Создаем поля в формате show как в админ-панели
                $vacancyFields = [
                    ID::make()->fillData(['id' => $vacancy->id], 0),
                    Text::make('Заголовок', 'title')
                        ->fillData(['title' => $vacancy->title], 0)
                        ->readonly(),
                    Textarea::make('Описание', 'description')
                        ->fillData(['description' => $vacancy->description], 0)
                        ->readonly(),
                ];

                if ($vacancy->schedule) {
                    $vacancyFields[] = Text::make('График работы', 'schedule')
                        ->fillData(['schedule' => $vacancy->schedule], 0)
                        ->readonly();
                }

                if ($vacancy->contact_info) {
                    $vacancyFields[] = Text::make('Контактные данные', 'contact_info')
                        ->fillData(['contact_info' => $vacancy->contact_info], 0)
                        ->readonly();
                }

                $containerComponents[] = Box::make($vacancy->title, $vacancyFields);
            }
        } else {
            $containerComponents[] = Box::make('Вакансии', [
                Text::make('Вакансий пока нет')
                    ->readonly(),
            ]);
        }

        if (empty($containerComponents)) {
            $containerComponents[] = Text::make('Информация пока не добавлена')
                ->readonly();
        }

        return [
            Box::make('Вакансия', $containerComponents),
        ];
    }
}

