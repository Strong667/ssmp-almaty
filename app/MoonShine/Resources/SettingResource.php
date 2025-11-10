<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
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
            Text::make('Заголовок', 'main_title'),
        ];
    }

    /**
     * Поля формы (создание/редактирование)
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Контент главной страницы', [
                ID::make()->readonly(),
                Text::make('Заголовок', 'main_title')->required(),
                Textarea::make('Описание', 'main_description')->required(),
                Image::make('Изображение', 'main_image')
                    ->dir('main') // сохранение в /storage/app/public/main
                    ->removable(),
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
            Text::make('Заголовок', 'main_title'),
            Textarea::make('Описание', 'main_description'),
            Image::make('Изображение', 'main_image'),
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
            'main_title' => ['required', 'string', 'max:255'],
            'main_description' => ['required', 'string'],
        ];
    }
}
