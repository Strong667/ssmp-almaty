<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;

/**
 * @extends ModelResource<Setting>
 */
class SettingResource extends ModelResource
{
    protected string $model = Setting::class;

    protected string $title = 'Главная страница';

    /**
     * Поля, отображаемые в списке записей
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'main_image')
                ->disk('public')
                ->dir('main')
                ->removable(),
        ];
    }

    /**
     * Поля формы (создание/редактирование)
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Галерея', [
                ID::make()->readonly(),
                Image::make('Изображение', 'main_image')
                    ->disk('public')
                    ->dir('main')
                    ->removable()
                    ->required(),
            ]),
        ];
    }

    /**
     * Поля для детального просмотра
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'main_image')
                ->disk('public')
                ->dir('main'),
        ];
    }

    /**
     * Валидация данных
     * @param Setting $item
     * @return array<string, string[]|string>
     */
    protected function rules(mixed $item): array
    {
        return [
            'main_image' => ['required', 'file', 'image', 'max:5120'],
        ];
    }
}
