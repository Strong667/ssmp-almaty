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
            Text::make('Название (русский)', 'title')->sortable(),
            Text::make('Название (казахский)', 'title_kk'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация (русский)', [
                Text::make('Название коммерческого предложения (русский)', 'title')
                    ->required()
                    ->placeholder('Введите название коммерческого предложения'),
                Textarea::make('Описание (русский)', 'description')
                    ->nullable()
                    ->placeholder('Введите описание коммерческого предложения'),
                File::make('Файл (русский)', 'file')
                    ->dir('paid-services')
                    ->disk('public')
                    ->removable()
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'])
                    ->hint('Можно загрузить изображение, PDF, DOC или DOCX'),
            ]),
            Box::make('Основная информация (казахский)', [
                Text::make('Название коммерческого предложения (казахский)', 'title_kk')
                    ->nullable()
                    ->placeholder('Введите название коммерческого предложения на казахском'),
                Textarea::make('Описание (казахский)', 'description_kk')
                    ->nullable()
                    ->placeholder('Введите описание коммерческого предложения на казахском'),
                File::make('Файл (казахский)', 'file_kk')
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
            Text::make('Название (русский)', 'title'),
            Text::make('Название (казахский)', 'title_kk'),
            Textarea::make('Описание (русский)', 'description'),
            Textarea::make('Описание (казахский)', 'description_kk'),
            File::make('Файл (русский)', 'file')->disk('public'),
            File::make('Файл (казахский)', 'file_kk')->disk('public'),
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
            'title_kk' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_kk' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
            'file_kk' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ];
    }
}

