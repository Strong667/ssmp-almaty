<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\{ID, Text, Image, Date};
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use Illuminate\Support\Str;

/**
 * @extends ModelResource<News>
 */
class NewsResource extends ModelResource
{
    protected string $model = News::class;
    protected string $title = 'Новости';

    /**
     * Отображаемые поля в таблице (index)
     *
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Date::make('Дата публикации', 'published_at'),
        ];
    }

    /**
     * Поля в форме создания/редактирования
     *
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make(),
                Text::make('Заголовок', 'title')->required(),
                TinyMce::make('Описание', 'description')->required(),
                Text::make('Видео (URL)', 'video_url')
                    ->placeholder('https://...')
                    ->hint('Ссылка на ролик YouTube или другой видеохостинг')
                    ->nullable(),
                Image::make('Изображение', 'image')
                    ->dir('news')
                    ->disk('public')
                    ->removable(),
                Date::make('Дата публикации', 'published_at'),
            ]),
        ];
    }

    /**
     * Поля на странице просмотра детали
     *
     * @return list<FieldContract>
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
     * Валидация
     *
     * @param News $item
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'video_url' => ['nullable', 'url'],
            'image' => ['nullable', 'image'],
        ];
    }

    public function beforeCreating(mixed $item): mixed
    {
        $item->slug = $this->makeUniqueSlug($item);

        return $item;
    }

    public function beforeUpdating(mixed $item): mixed
    {
        $item->slug = $this->makeUniqueSlug($item);

        return $item;
    }

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
                ->when($item->exists, fn ($query) => $query->where('id', '!=', $item->id))
                ->exists()
        ) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
