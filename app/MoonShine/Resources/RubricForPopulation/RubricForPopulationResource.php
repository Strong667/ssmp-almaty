<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\RubricForPopulation;

use App\Models\RubricForPopulation;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea, Image, Select, Number, File};

class RubricForPopulationResource extends ModelResource
{
    protected string $model = RubricForPopulation::class;
    protected string $title = 'Рубрика для населения';

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')
                ->sortable(),
            Image::make('Картинка', 'image')
                ->disk('public')
                ->readonly(),
            Select::make('Тип контента', 'type')
                ->options([
                    'text' => 'Текст',
                    'pdf' => 'PDF файл',
                    'video' => 'YouTube видео',
                    'images' => 'Изображение',
                ])
                ->sortable(),
        ];
    }

    /**
     * Поля в форме создания/редактирования
     *
     * @return iterable
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Text::make('Название', 'title')
                    ->required()
                    ->placeholder('Введите название рубрики'),
                Textarea::make('Описание', 'description')
                    ->customAttributes(['rows' => 5])
                    ->required()
                    ->placeholder('Введите описание рубрики'),
                Image::make('Картинка', 'image')
                    ->dir('rubric-for-population')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->hint('Основное изображение рубрики (миниатюра для карточки)'),
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
                File::make('PDF файл', 'file_path')
                    ->dir('rubric-for-population')
                    ->disk('public')
                    ->removable()
                    ->allowedExtensions(['pdf'])
                    ->when(
                        fn ($item) => !$item || ($item instanceof RubricForPopulation && $item->type === 'pdf'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Загрузите PDF файл, если тип контента - "PDF файл"'),
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
                Image::make('Изображение', 'file_path')
                    ->dir('rubric-for-population')
                    ->disk('public')
                    ->removable()
                    ->when(
                        fn ($item) => !$item || ($item instanceof RubricForPopulation && $item->type === 'images'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Загрузите изображение, если тип контента - "Изображение"'),
            ]),
        ];
    }

    /**
     * Поля на странице просмотра детали
     *
     * @return iterable
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title')
                ->readonly(),
            Image::make('Картинка', 'image')
                ->disk('public'),
            Select::make('Тип контента', 'type')
                ->options([
                    'text' => 'Текст',
                    'pdf' => 'PDF файл',
                    'video' => 'YouTube видео',
                    'images' => 'Изображения',
                ])
                ->readonly(),
            Textarea::make('Описание', 'description')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Текст/URL', 'content')
                ->readonly()
                ->customAttributes(['rows' => 10]),
            File::make('PDF файл/Изображение', 'file_path')
                ->disk('public')
                ->readonly(),
        ];
    }

    /**
     * Хук перед сохранением (создание или обновление)
     *
     * @param  mixed  $item
     * @return void
     */
    protected function saving(mixed $item): void
    {
        if ($item instanceof RubricForPopulation) {
            // Автоматически устанавливаем order при создании
            if (!$item->exists) {
                $maxOrder = RubricForPopulation::query()->max('order') ?? -1;
                $item->order = $maxOrder + 1;
            }
            
            // Обрабатываем video_content и переносим в content для типа video
            if ($item->type === 'video') {
                $videoContent = request()->input('video_content');
                if ($videoContent !== null && $videoContent !== '') {
                    // Сохраняем video_content в content
                    $item->content = trim($videoContent);
                } elseif (!$item->exists && empty($item->content)) {
                    // Если это новый блок и video_content пустой, берем из запроса еще раз
                    $videoContent = request()->input('video_content', '');
                    if (!empty($videoContent)) {
                        $item->content = trim($videoContent);
                    }
                }
            }
            
            // Удаляем video_content из атрибутов модели, чтобы не попало в SQL запрос
            if ($item->getAttributes() && array_key_exists('video_content', $item->getAttributes())) {
                $item->offsetUnset('video_content');
            }
            
            // Очищаем ненужные поля в зависимости от типа контента
            if ($item->type === 'text') {
                $item->file_path = null;
            } elseif ($item->type === 'pdf') {
                $item->content = null;
            } elseif ($item->type === 'video') {
                $item->file_path = null;
            } elseif ($item->type === 'images') {
                $item->content = null;
            }
        }
    }

    /**
     * Правила валидации
     *
     * @param  mixed  $item
     * @return array
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
            'type' => ['required', 'in:text,pdf,video,images'],
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
                'mimes:pdf,jpg,jpeg,png',
            ],
            'video_content' => [
                'required_if:type,video',
                'nullable',
                'string',
            ],
        ];
    }
}

