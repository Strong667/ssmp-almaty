<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\About\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use App\Models\MissionValue;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\UI\Fields\Text;

#[SkipMenu]
class MissionPage extends Page
{

    public function getTitle(): string
    {
        return 'Миссия и ценности';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => 'Главная',
            '/about/mission' => $this->getTitle()
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $missionValues = MissionValue::query()
            ->orderBy('title')
            ->get();

        // Подготавливаем данные для CardsBuilder
        $missionValuesData = $missionValues->map(function (MissionValue $missionValue) {
            $description = strip_tags($missionValue->description ?? '');
            $shortDescription = mb_strlen($description) > 150 
                ? mb_substr($description, 0, 150) . '...' 
                : $description;
            
            return [
                'id' => $missionValue->id,
                'title' => $missionValue->title,
                'description' => $shortDescription,
                'full_description' => $description,
            ];
        })->toArray();

        return [
            Box::make('Миссия и ценности', [
                $missionValues->isNotEmpty()
                    ? CardsBuilder::make($missionValuesData, [])
                        ->title(fn ($data) => $data['title'] ?? '')
                        ->subtitle(fn ($data) => $data['description'] ?? '')
                        ->content('')
                        ->componentAttributes(fn ($data) => [
                            'style' => 'min-height: 200px; display: flex; flex-direction: column;',
                            'class' => 'mission-value-card'
                        ])
                        ->columnSpan(6)  // 2 карточки в ряд (12/6=2)
                    : Text::make('Миссия и ценности пока не добавлены')
                        ->readonly(),
            ]),
        ];
    }
}

