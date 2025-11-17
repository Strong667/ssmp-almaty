<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\RubricForPopulation\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\RubricForPopulation\RubricForPopulationResource;
use App\Models\RubricForPopulation;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<RubricForPopulationResource>
 */
class RubricForPopulationFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Text::make('Название', 'title')
                    ->required()
                    ->placeholder('Введите название рубрики'),
                Textarea::make('Описание', 'description')
                    ->customAttributes(['rows' => 5])
                    ->nullable()
                    ->placeholder('Введите описание рубрики (необязательно)'),
                Image::make('Картинка', 'image')
                    ->dir('rubric-for-population')
                    ->disk('public')
                    ->removable()
                    ->nullable()
                    ->hint('Верхнее изображение рубрики (необязательно, не входит в контент)'),
                Select::make('Тип контента', 'type')
                    ->options([
                        'text' => 'Текст',
                        'pdf' => 'PDF файл',
                        'video' => 'YouTube видео',
                        'images' => 'Изображение',
                    ])
                    ->required()
                    ->hint('Выберите тип контента для отображения на детальной странице'),
            ]),
            Box::make('Контент', [
                Textarea::make('Текст', 'content')
                    ->customAttributes(['rows' => 10])
                    ->when(
                        fn ($item) => !$item || ($item instanceof RubricForPopulation && $item->type === 'text'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Заполните, если тип контента - "Текст"'),
                File::make('Файл (PDF или изображение)', 'file_path')
                    ->dir('rubric-for-population')
                    ->disk('public')
                    ->removable()
                    ->allowedExtensions(['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp'])
                    ->hint('Загрузите PDF файл (для типа "PDF файл") или изображение (для типа "Изображение")'),
                Text::make('URL видео YouTube', 'video_content')
                    ->default(function ($item) {
                        if ($item instanceof RubricForPopulation && $item->type === 'video') {
                            return $item->content;
                        }
                        return null;
                    })
                    ->placeholder('https://www.youtube.com/watch?v=... или https://youtu.be/...')
                    ->when(
                        fn ($item) => !$item || ($item instanceof RubricForPopulation && $item->type === 'video'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Вставьте ссылку на видео YouTube, если тип контента - "YouTube видео"'),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:10240'],
            'type' => ['required', 'string', 'in:text,pdf,video,images'],
            'content' => [
                'required_if:type,text',
                'required_if:type,video',
                'nullable',
                'string',
            ],
            'file_path' => [
                'required_if:type,pdf',
                'required_if:type,images',
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,gif,webp',
            ],
            'video_content' => [
                'required_if:type,video',
                'nullable',
                'string',
            ],
        ];
    }


    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

