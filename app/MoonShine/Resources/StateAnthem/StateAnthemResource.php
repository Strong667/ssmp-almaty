<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\StateAnthem;

use App\Models\StateAnthem;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Image, Textarea, File};

class StateAnthemResource extends ModelResource
{
    protected string $model = StateAnthem::class;
    protected string $title = 'Государственный Гимн';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->disk('public')
                ->readonly(),
            Textarea::make('Описание', 'description'),
            File::make('Аудио файл', 'audio_file')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()->readonly(),
                Image::make('Изображение', 'image')
                    ->dir('state-symbols')
                    ->disk('public')
                    ->removable()
                    ->required()
                    ->hint('Загрузите изображение'),
                Textarea::make('Описание', 'description')
                    ->required()
                    ->customAttributes(['rows' => 5])
                    ->placeholder('Введите описание гимна'),
                Textarea::make('Текст гимна', 'text')
                    ->required()
                    ->customAttributes(['rows' => 10])
                    ->placeholder('Введите текст гимна'),
                File::make('Аудио файл', 'audio_file')
                    ->dir('state-symbols')
                    ->disk('public')
                    ->removable()
                    ->allowedExtensions(['mp3', 'wav', 'ogg', 'm4a'])
                    ->nullable()
                    ->hint('Загрузите аудио файл гимна (mp3, wav, ogg, m4a)'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Изображение', 'image')
                ->disk('public'),
            Textarea::make('Описание', 'description')
                ->readonly()
                ->customAttributes(['rows' => 5]),
            Textarea::make('Текст гимна', 'text')
                ->readonly()
                ->customAttributes(['rows' => 10]),
            File::make('Аудио файл', 'audio_file')
                ->disk('public')
                ->readonly(),
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'image' => ['required', 'image'],
            'description' => ['required', 'string'],
            'text' => ['required', 'string'],
            'audio_file' => ['nullable', 'file', 'mimes:mp3,wav,ogg,m4a'],
        ];
    }
}

