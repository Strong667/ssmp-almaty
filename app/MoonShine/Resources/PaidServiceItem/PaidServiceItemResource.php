<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PaidServiceItem;

use App\Models\PaidServiceItem;
use App\Models\PaidService;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<PaidServiceItem>
 */
class PaidServiceItemResource extends ModelResource
{
    protected string $model = PaidServiceItem::class;

    protected string $title = 'Услуги платных услуг';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Наименование (русский)', 'name')->sortable(),
            Text::make('Наименование (казахский)', 'name_kk'),
            Text::make('Ед. изм.', 'unit'),
            Number::make('Стоимость (тенге)', 'price')->sortable(),
            Number::make('Порядок', 'order')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Информация об услуге', [
                Select::make('Платная услуга', 'paid_service_id')
                    ->options(PaidService::pluck('id', 'id')->toArray())
                    ->required()
                    ->searchable(),
                Text::make('Наименование (русский)', 'name')
                    ->required()
                    ->placeholder('Введите наименование услуги'),
                Text::make('Наименование (казахский)', 'name_kk')
                    ->nullable()
                    ->placeholder('Введите наименование услуги на казахском'),
                Text::make('Ед. изм.', 'unit')
                    ->required()
                    ->placeholder('Например: 1 (один) час'),
                Number::make('Стоимость (тенге), без учета НДС', 'price')
                    ->required()
                    ->min(0)
                    ->step(0.01)
                    ->placeholder('Введите стоимость'),
                Number::make('Порядок сортировки', 'order')
                    ->default(0)
                    ->min(0),
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
            Text::make('Наименование (русский)', 'name'),
            Text::make('Наименование (казахский)', 'name_kk'),
            Text::make('Ед. изм.', 'unit'),
            Number::make('Стоимость (тенге)', 'price'),
            Number::make('Порядок', 'order'),
        ];
    }

    /**
     * @param PaidServiceItem $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'paid_service_id' => ['required', 'exists:paid_services,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_kk' => ['nullable', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}

