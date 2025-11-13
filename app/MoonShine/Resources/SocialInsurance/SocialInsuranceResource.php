<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SocialInsurance;

use App\Models\SocialInsurance;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Textarea, Image, Select, Number};
use MoonShine\Support\Enums\Color;

class SocialInsuranceResource extends ModelResource
{
    protected string $model = SocialInsurance::class;
    protected string $title = 'Обязательное социальное медицинское страхование';

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Number::make('Порядок', 'order')
                ->sortable(),
            Select::make('Тип блока', 'type')
                ->options([
                    'text' => 'Текст',
                    'image' => 'Изображение',
                    'video' => 'Видео',
                ])
                ->sortable(),
            Textarea::make('Содержимое', 'content')
                ->readonly(),
            Image::make('Изображение', 'image')
                ->disk('public')
                ->readonly(),
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
                Select::make('Тип блока', 'type')
                    ->options([
                        'text' => 'Текст',
                        'image' => 'Изображение',
                        'video' => 'Видео',
                    ])
                    ->required()
                    ->hint('Выберите тип блока контента'),
                Number::make('Порядок отображения', 'order')
                    ->default(function ($item) {
                        if (!$item || !$item->exists) {
                            $maxOrder = SocialInsurance::query()->max('order') ?? -1;
                            return $maxOrder + 1;
                        }
                        return $item->order ?? 0;
                    })
                    ->required()
                    ->hint('Чем меньше число, тем выше блок будет отображаться. Можно изменить порядок, редактируя это поле'),
            ]),
            Box::make('Контент блока', [
                Textarea::make('Текст', 'content')
                    ->customAttributes(['rows' => 10])
                    ->when(
                        fn ($item) => !$item || ($item instanceof SocialInsurance && $item->type === 'text'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Заполните, если тип блока - "Текст"'),
                Image::make('Изображение', 'image')
                    ->dir('social-insurance')
                    ->disk('public')
                    ->removable()
                    ->when(
                        fn ($item) => !$item || ($item instanceof SocialInsurance && $item->type === 'image'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Загрузите изображение, если тип блока - "Изображение"'),
                Text::make('URL видео YouTube', 'video_content')
                    ->default(function ($item) {
                        if ($item instanceof SocialInsurance && $item->type === 'video') {
                            return $item->content;
                        }
                        return null;
                    })
                    ->placeholder('https://www.youtube.com/watch?v=... или https://youtu.be/...')
                    ->when(
                        fn ($item) => !$item || ($item instanceof SocialInsurance && $item->type === 'video'),
                        fn ($field) => $field->required()
                    )
                    ->hint('Вставьте ссылку на видео YouTube, если тип блока - "Видео"'),
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
            Select::make('Тип блока', 'type')
                ->options([
                    'text' => 'Текст',
                    'image' => 'Изображение',
                    'video' => 'Видео',
                ])
                ->readonly(),
            Number::make('Порядок', 'order')
                ->readonly(),
            Textarea::make('Текст/URL', 'content')
                ->readonly()
                ->customAttributes(['rows' => 10]),
            Image::make('Изображение', 'image')->disk('public'),
        ];
    }

    /**
     * Правила валидации
     *
     * @param  mixed  $item
     * @return array
     */
    /**
     * Хук перед сохранением (создание или обновление)
     *
     * @param  mixed  $item
     * @return void
     */
    protected function saving(mixed $item): void
    {
        if ($item instanceof SocialInsurance) {
            // Если создается новый блок и order не указан, устанавливаем максимальный order + 1
            if (!$item->exists && !$item->order) {
                $maxOrder = SocialInsurance::query()->max('order') ?? -1;
                $item->order = $maxOrder + 1;
            }
            
            // Обрабатываем video_content и переносим в content для типа video
            if ($item->type === 'video') {
                $videoContent = request()->input('video_content');
                if ($videoContent !== null && $videoContent !== '') {
                    $item->content = $videoContent;
                } elseif (!$item->exists) {
                    // Если это новый блок и video_content пустой, берем из запроса
                    $videoContent = request()->input('video_content', '');
                    if (!empty($videoContent)) {
                        $item->content = $videoContent;
                    }
                }
            }
            
            // Очищаем ненужные поля в зависимости от типа блока
            if ($item->type === 'image') {
                // Для изображений content не нужен
                $item->content = null;
            } elseif ($item->type === 'text') {
                // Для текста image не нужен, если не загружается новое
                if (!$item->isDirty('image') || empty($item->image)) {
                    $item->image = null;
                }
            } elseif ($item->type === 'video') {
                // Для видео image не нужен, если не загружается новое
                if (!$item->isDirty('image') || empty($item->image)) {
                    $item->image = null;
                }
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
            'type' => ['required', 'in:text,image,video'],
            'order' => ['required', 'integer', 'min:0'],
            'content' => [
                'required_if:type,text',
                'nullable',
                'string',
            ],
            'video_content' => [
                'required_if:type,video',
                'nullable',
                'string',
            ],
            'image' => [
                'required_if:type,image',
                'nullable',
                'image',
            ],
        ];
    }
}
