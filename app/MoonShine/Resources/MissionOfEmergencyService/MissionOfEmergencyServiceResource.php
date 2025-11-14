<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MissionOfEmergencyService;

use App\Models\MissionOfEmergencyService;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<MissionOfEmergencyService>
 */
class MissionOfEmergencyServiceResource extends ModelResource
{
    protected string $model = MissionOfEmergencyService::class;

    protected string $title = 'Миссия скорой помощи';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Изображение', [
                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->required(),
            ]),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'image')->disk('public'),
        ];
    }

    /**
     * @param MissionOfEmergencyService $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'image' => ['required', 'image', 'max:2048'],
        ];
    }
}

