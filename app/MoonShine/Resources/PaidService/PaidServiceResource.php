<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PaidService;

use App\Models\PaidService;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\File;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use App\MoonShine\Resources\PaidServiceItem\PaidServiceItemResource;

/**
 * @extends ModelResource<PaidService>
 */
class PaidServiceResource extends ModelResource
{
    protected string $model = PaidService::class;
    protected string $title = 'Платные услуги';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                Text::make('Название коммерческого предложения', 'title')
                    ->required()
                    ->placeholder('Введите название коммерческого предложения'),
                Textarea::make('Описание', 'description')
                    ->nullable()
                    ->placeholder('Введите описание коммерческого предложения'),
                File::make('Файл', 'file')
                    ->dir('paid-services')
                    ->disk('public')
                    ->removable()
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'])
                    ->hint('Можно загрузить изображение, PDF, DOC или DOCX'),
            ]),
            HasMany::make('Услуги', 'items', resource: PaidServiceItemResource::class)
                ->creatable(),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Textarea::make('Описание', 'description'),
            File::make('Файл', 'file')->disk('public'),
        ];
    }

    /**
     * @param PaidService $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ];
    }
}

