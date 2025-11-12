<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\News;

use App\Models\News;
use Illuminate\Support\Str;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Image, Date};
use MoonShine\TinyMce\Fields\TinyMce;

class NewsResource extends ModelResource
{
    protected string $model = News::class;
    protected string $title = 'Новости';

    /** Если нужны eager‑загрузки: */
    // protected array $with = [];

    /**
     * Поля в таблице (index)
     *
     * @return iterable
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title')->sortable(),
            Date::make('Дата публикации', 'published_at')->sortable(),
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
                Text::make('Заголовок', 'title')
                    ->required()
                    ->justSaved(fn (News $item) => $item->slug = $this->makeUniqueSlug($item)),
                TinyMce::make('Описание', 'description')->required(),
                Text::make('Видео (URL)', 'video_url')
                    ->placeholder('https://...')
                    ->hint('Ссылка на ролик YouTube или другой видеохостинг')
                    ->nullable(),
                Image::make('Изображение', 'image')
                    ->dir('news')
                    ->disk('public')
                    ->removable()
                    ->nullable(),
                Date::make('Дата публикации', 'published_at')->required(),
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
            Text::make('Заголовок', 'title'),
            TinyMce::make('Описание', 'description'),
            Text::make('Видео (URL)', 'video_url'),
            Image::make('Изображение', 'image')->disk('public'),
            Date::make('Дата публикации', 'published_at'),
        ];
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
            'title'      => ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            'video_url'  => ['nullable', 'url'],
            'image'      => ['nullable', 'image'],
            'published_at'=> ['required', 'date'],
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
        if ($item instanceof News) {
            $item->slug = $this->makeUniqueSlug($item);
        }
    }

    /**
     * Генерация уникального slug
     *
     * @param  News  $item
     * @return string
     */
    private function makeUniqueSlug(News $item): string
    {
        $base = Str::slug($item->title ?? '', '-', 'ru')
            ?: Str::slug($item->title ?? '', '-', app()->getFallbackLocale())
                ?: 'news';

        $slug = $base;
        $suffix = 1;

        while (
        News::query()
            ->where('slug', $slug)
            ->when($item->exists, fn($q) => $q->where('id', '!=', $item->id))
            ->exists()
        ) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    /**
     * Поля для поиска
     *
     * @return array
     */
    protected function search(): array
    {
        return [
            'title',
        ];
    }
}
