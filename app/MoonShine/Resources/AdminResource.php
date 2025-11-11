<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Admin;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Admin>
 */
class AdminResource extends ModelResource
{
    protected string $model = Admin::class;

    protected string $title = 'Администрация';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Text::make('Почта', 'email'),
            Image::make('Картинка', 'image')->disk('public'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('ФИО', 'full_name')->required(),
                Text::make('Должность', 'position')->required(),
                Text::make('Почта', 'email')->required(),
                Image::make('Картинка', 'image')->disk('public'),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('ФИО', 'full_name'),
            Text::make('Должность', 'position'),
            Text::make('Почта', 'email'),
            Image::make('Картинка', 'image')->disk('public'),
        ];
    }

    /**
     * @param Admin $item
     *
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,' . ($item->id ?? 'null')],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
