<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\MedicalEmploymentInfo;

use App\Models\MedicalEmploymentInfo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\File;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<MedicalEmploymentInfo>
 */
class MedicalEmploymentInfoResource extends ModelResource
{
    protected string $model = MedicalEmploymentInfo::class;

    protected string $title = 'Информация для медицинских специалистов';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
            Text::make('Заголовок', 'title')
                    ->required()
                    ->placeholder('Например: Требования к медицинским специалистам'),
            Textarea::make('Описание', 'description')
                ->required()
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Подробная информация для медицинских специалистов'),
            File::make('Прикрепленный файл', 'attachment')
                ->disk('public')
                ->dir('employment_info')
                ->allowedExtensions(['pdf', 'doc', 'docx'])
                ->nullable(),
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
            Text::make('Заголовок', 'title'),
            Textarea::make('Описание', 'description'),
            File::make('Прикрепленный файл', 'attachment')->disk('public'),
        ];
    }

    /**
     * @param MedicalEmploymentInfo $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ];
    }
}
