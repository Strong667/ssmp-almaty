<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\MedicalHelpForForeigners;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\ID;

#[SkipMenu]
class MedicalHelpForForeignersPage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Оказание медицинской помощи иностранному гражданину в РК';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/medical-help-for-foreigners' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $items = MedicalHelpForForeigners::query()
            ->orderBy('created_at')
            ->get();

        $containerComponents = [];

        if ($items->isNotEmpty()) {
            foreach ($items as $item) {
                $fields = [
                    ID::make()->fillData(['id' => $item->id], 0),
                    Text::make('Название', 'title')
                        ->fillData(['title' => $item->title], 0)
                        ->readonly(),
                ];

                if ($item->description) {
                    $fields[] = Textarea::make('Описание', 'description')
                        ->fillData(['description' => $item->description], 0)
                        ->readonly()
                        ->customAttributes(['rows' => 10]);
                }

                $containerComponents[] = Box::make($item->title, $fields);
            }
        } else {
            $containerComponents[] = Box::make('Оказание медицинской помощи иностранному гражданину в РК', [
                Text::make('Информация пока не добавлена')
                    ->readonly(),
            ]);
        }

        return [
            Box::make('Оказание медицинской помощи иностранному гражданину в РК', $containerComponents),
        ];
    }
}

