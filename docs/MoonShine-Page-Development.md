# Разработка страниц через MoonShine Components

## Обзор архитектуры

Главная страница (`HomePage`) разработана с использованием **компонентного подхода MoonShine**, где весь UI создается через PHP классы и объекты, которые автоматически рендерятся в HTML через Blade шаблоны.

## Технологический стек

| Уровень | Технология | Назначение |
|---------|-----------|-----------|
| **Backend** | PHP 8.2+ | Логика, классы компонентов, объектно-ориентированное программирование |
| **Framework** | Laravel 12 | Роутинг, Dependency Injection, работа с БД |
| **UI Library** | MoonShine 4.0 | Готовая библиотека компонентов (Box, FormBuilder, Heading и др.) |
| **Templating** | Blade | Шаблоны для рендеринга HTML (встроены в MoonShine) |
| **Frontend JS** | Alpine.js | Интерактивность форм и компонентов (через MoonShine) |
| **Styling** | Tailwind CSS | Стили компонентов (через MoonShine) |

## Структура разработки

### 1. Создание страницы

Создайте PHP класс, наследующийся от `MoonShine\Laravel\Pages\Page`:

```php
<?php

namespace App\MoonShine\Resources\Home\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;

#[SkipMenu]  // Исключить из меню админки
class HomePage extends Page
{
    // Указать layout для публичных страниц
    protected ?string $layout = GuestLayout::class;

    // Заголовок страницы
    public function getTitle(): string
    {
        return 'Главная';
    }

    // Хлебные крошки
    public function getBreadcrumbs(): array
    {
        return [
            '/' => $this->getTitle()
        ];
    }

    // Главный метод - возвращает массив компонентов
    protected function components(): iterable
    {
        return [
            // Здесь размещаем компоненты
        ];
    }
}
```

### 2. Роутинг

В `routes/web.php`:

```php
use App\MoonShine\Resources\Home\Pages\HomePage;

Route::get('/', function () {
    $page = app(HomePage::class);
    return $page->render();  // Рендерит страницу в HTML
})->name('home');
```

## Доступные компоненты MoonShine

### Базовые компоненты

#### Box - Контейнер для группировки
```php
use MoonShine\UI\Components\Layout\Box;

Box::make('Заголовок блока', [
    // Дочерние компоненты
])
```

#### Heading - Заголовки
```php
use MoonShine\UI\Components\Heading;

Heading::make('Текст заголовка', 2)  // 2 = h2 (1-6)
Heading::make('Текст заголовка', 3)  // 3 = h3
```

#### Div - Блок для группировки
```php
use MoonShine\UI\Components\Layout\Div;

Div::make([
    // Компоненты внутри
])
```

#### Flex - Flexbox контейнер
```php
use MoonShine\UI\Components\Layout\Flex;

Flex::make(
    components: [
        // Компоненты
    ],
    justifyAlign: 'between',  // 'start', 'center', 'end', 'between', 'around', 'evenly'
    itemsAlign: 'center'      // 'start', 'center', 'end'
)
```

### Формы и поля

#### FormBuilder - Форма
```php
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Support\Enums\FormMethod;

FormBuilder::make(
    action: route('home'),
    method: FormMethod::POST,
    fields: [
        // Поля формы
    ]
)
->buttons([
    // Кнопки формы
])
```

#### Поля формы

**Text** - Текстовое поле:
```php
use MoonShine\UI\Fields\Text;

Text::make('Метка', 'field_name')
    ->required()
    ->placeholder('Подсказка')
    ->readonly()  // Только для чтения
```

**Email** - Email поле:
```php
use MoonShine\UI\Fields\Email;

Email::make('Email', 'email')
    ->required()
    ->placeholder('Введите email')
```

**Textarea** - Многострочное поле:
```php
use MoonShine\UI\Fields\Textarea;

Textarea::make('Сообщение', 'message')
    ->required()
    ->placeholder('Введите текст')
    ->customAttributes(['rows' => 5])  // Количество строк
```

#### ActionButton - Кнопка
```php
use MoonShine\UI\Components\ActionButton;

ActionButton::make('Текст кнопки')
    ->primary()  // Стиль: primary, secondary, success, warning, error
    ->customAttributes(['type' => 'submit'])  // Для формы
```

### Навигация

#### Link - Ссылка
```php
use MoonShine\UI\Components\Link;

Link::make(route('about.administration'), 'Администрация')
    ->icon('users')  // Иконка из библиотеки MoonShine
```

**Доступные иконки:**
- `home`, `users`, `user-circle`, `user-group`
- `calendar`, `calendar-days`
- `building-office`, `building-office-2`, `building-library`
- `information-circle`, `cog-6-tooth`
- И многие другие (см. `/vendor/moonshine/.../icons/`)

## Полный пример страницы

```php
<?php

namespace App\MoonShine\Resources\Home\Pages;

use App\MoonShine\Layouts\GuestLayout;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\MenuManager\Attributes\SkipMenu;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Components\ActionButton;
use MoonShine\Support\Enums\FormMethod;

#[SkipMenu]
class HomePage extends Page
{
    protected ?string $layout = GuestLayout::class;

    public function getTitle(): string
    {
        return 'Главная';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/' => $this->getTitle()
        ];
    }

    protected function components(): iterable
    {
        return [
            // Блок с приветствием
            Box::make('Главная страница', [
                Heading::make('Добро пожаловать', 2),
                Text::make('Это главная страница сайта')
                    ->readonly(),
            ]),

            // Информационный блок
            Box::make('Информация', [
                Heading::make('О нашем сайте', 3),
                Div::make([
                    Text::make('Описание 1')
                        ->readonly(),
                    Text::make('Описание 2')
                        ->readonly(),
                ]),
            ]),

            // Форма обратной связи
            Box::make('Форма обратной связи', [
                Heading::make('Свяжитесь с нами', 3),
                FormBuilder::make(
                    action: route('home'),
                    method: FormMethod::POST,
                    fields: [
                        Email::make('Email', 'email')
                            ->required()
                            ->placeholder('Введите ваш email'),
                        Text::make('Имя', 'name')
                            ->required()
                            ->placeholder('Введите ваше имя'),
                        Textarea::make('Сообщение', 'message')
                            ->required()
                            ->placeholder('Введите ваше сообщение')
                            ->customAttributes(['rows' => 5]),
                    ]
                )
                    ->buttons([
                        ActionButton::make('Отправить')
                            ->primary()
                            ->customAttributes(['type' => 'submit']),
                    ]),
            ]),

            // Блок с ссылками
            Box::make('Быстрые ссылки', [
                Heading::make('Навигация', 3),
                Flex::make(
                    components: [
                        Link::make(route('about.administration'), 'Администрация')
                            ->icon('users'),
                        Link::make(route('about.schedule'), 'График приёма')
                            ->icon('calendar-days'),
                        Link::make(route('about.structure'), 'Структура')
                            ->icon('building-office'),
                    ],
                    justifyAlign: 'between'
                ),
            ]),
        ];
    }
}
```

## Процесс рендеринга: PHP → HTML

### Шаг 1: Роут вызывает render()
```php
Route::get('/', function () {
    $page = app(HomePage::class);
    return $page->render();  // ← Начало рендеринга
});
```

### Шаг 2: Page рендерит через Layout
```php
// Внутри Page::render()
GuestLayout::build()           // Строит структуру страницы
    -> Content::make($components)  // Вставляет компоненты
```

### Шаг 3: Компоненты рендерятся через Blade
```php
// Каждый компонент имеет свой Blade шаблон
Box::class → 'moonshine::components.layout.box'
FormBuilder::class → 'moonshine::components.form.builder'
Heading::class → 'moonshine::components.heading'
```

### Шаг 4: Blade генерирует HTML
```blade
{{-- box.blade.php --}}
<div class="box">
    <h3>{{ $label }}</h3>
    {{ $slot }}  {{-- Дочерние компоненты --}}
</div>
```

### Шаг 5: Итоговый HTML в браузере
```html
<div class="box">
    <h3>Главная страница</h3>
    <h2>Добро пожаловать</h2>
    <input type="text" readonly value="Это главная страница сайта">
</div>
```

## Работа с данными из БД

### Загрузка и отображение новостей

```php
protected function components(): iterable
{
    // 1. Загрузка данных из БД
    $news = News::query()
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get();

    // 2. Обработка данных (добавление URL изображений)
    $news->each(function (News $item) {
        $item->image_url = $item->image
            ? Storage::disk('public')->url($item->image)
            : null;
    });

    // 3. Создание компонентов для каждой новости
    $newsComponents = [];
    foreach ($news as $item) {
        $cardComponents = [
            // Заголовок новости
            Heading::make($item->title, 4),
            // Дата публикации
            Text::make('Дата публикации')
                ->setValue($item->display_date)
                ->readonly(),
            // Описание (обрезаем до 150 символов)
            Text::make('Описание')
                ->setValue(mb_substr(strip_tags($item->description), 0, 150) . 
                    (mb_strlen(strip_tags($item->description)) > 150 ? '...' : ''))
                ->readonly(),
        ];

        // Добавляем информацию об изображении, если есть
        if ($item->image_url) {
            $cardComponents[] = Text::make('Изображение')
                ->setValue('Есть изображение')
                ->readonly();
        }

        // Ссылка на новость
        $cardComponents[] = Link::make('#', 'Читать далее')
            ->icon('arrow-right');

        // Создаем Box (карточку) для новости
        $newsComponents[] = Box::make(
            label: '',
            components: $cardComponents
        )->customAttributes([
            'style' => 'margin-bottom: 1rem; min-width: 300px; flex: 1 1 300px;'
        ]);
    }

    return [
        // 4. Отображение новостей в сетке
        Box::make('Новости', [
            Heading::make('Актуальные новости', 3),
            // Если есть новости, показываем их в сетке
            $news->isNotEmpty() 
                ? Flex::make(
                    components: $newsComponents,
                    justifyAlign: 'start',
                    itemsAlign: 'start'
                )->wrap()  // Перенос на новую строку при переполнении
                : Text::make('Новостей пока нет')
                    ->readonly(),
        ]),
    ];
}
```

### Структура отображения новостей

1. **Загрузка данных** - через Eloquent Query Builder
2. **Обработка данных** - добавление вычисляемых полей (URL изображений)
3. **Создание компонентов** - для каждой записи создается Box с компонентами внутри
4. **Группировка** - все карточки оборачиваются в Flex для сетки
5. **Условное отображение** - проверка наличия данных перед выводом

### Использование CardsBuilder для карточек с изображениями

Для создания красивых карточек с изображениями, текстом поверх изображения и бейджами используйте `CardsBuilder`:

```php
use MoonShine\UI\Components\CardsBuilder;
use MoonShine\UI\Components\Badge;
use MoonShine\Support\Enums\Color;

// Подготовка данных
$newsData = $news->map(function (News $item) {
    return [
        'id' => $item->id,
        'title' => $item->title,
        'subtitle' => mb_substr(strip_tags($item->description), 0, 100) . '...',
        'thumbnail' => $item->image_url,
        'date' => $item->display_date,
        'description' => mb_substr(strip_tags($item->description), 0, 150) . '...',
    ];
})->toArray();

// Создание карточек
CardsBuilder::make($newsData, [])
    ->thumbnail(fn ($data) => $data['thumbnail'] ?? '')  // Изображение
    ->title(fn ($data) => $data['title'] ?? '')          // Заголовок
    ->subtitle(fn ($data) => $data['subtitle'] ?? '')    // Подзаголовок
    ->overlay()                                           // Текст поверх изображения
    ->topLeft(fn () => [                                  // Бейдж в левом верхнем углу
        Badge::make('new', Color::PURPLE)
    ])
    ->content(fn ($data) =>                               // Контент ниже карточки
        '<div style="padding: 1rem 0;">
            <div><strong>Дата:</strong> ' . e($data['date'] ?? '') . '</div>
            <div style="margin-top: 0.5rem;">' . e($data['description'] ?? '') . '</div>
        </div>'
    )
    ->columnSpan(4)  // 3 карточки в ряд (12/4=3)
```

**Методы CardsBuilder:**
- `thumbnail()` - URL изображения для карточки
- `title()` - Заголовок карточки
- `subtitle()` - Подзаголовок карточки
- `overlay()` - Включает режим наложения текста поверх изображения
- `topLeft()` - Компоненты в левом верхнем углу (бейджи)
- `topRight()` - Компоненты в правом верхнем углу
- `content()` - HTML контент ниже карточки
- `columnSpan()` - Ширина карточки в колонках (4 = 3 карточки в ряд)

## Layout для публичных страниц

Создайте кастомный Layout:

```php
<?php

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\UI\Components\Layout\TopBar;
use MoonShine\UI\Components\Link;

final class GuestLayout extends AppLayout
{
    protected bool $contentCentered = true;  // Центрировать контент
    protected bool $contentSimpled = true;   // Упрощенный вид

    protected function getTopBarComponent(): TopBar
    {
        return TopBar::make([
            // Навигация для публичных страниц
            Link::make(route('home'), 'Главная')
                ->icon('home'),
        ]);
    }
}
```

## Преимущества подхода

1. **Декларативность** - описываете структуру, а не HTML
2. **Переиспользование** - компоненты можно использовать везде
3. **Типобезопасность** - PHP проверяет типы на этапе разработки
4. **Автоматический рендеринг** - не нужно писать HTML вручную
5. **Единый стиль** - все компоненты используют стили MoonShine
6. **Интерактивность** - формы работают через Alpine.js автоматически

## Ограничения и особенности

1. **Только PHP** - весь UI код на PHP, нет JSX/TSX
2. **Blade шаблоны** - рендеринг через Blade (встроены в MoonShine)
3. **Ограниченная кастомизация** - стили контролируются MoonShine
4. **Зависимость от MoonShine** - нужно знать API компонентов

## Полезные ссылки

- [MoonShine Documentation](https://moonshine-laravel.com/)
- Компоненты: `/vendor/moonshine/moonshine/src/UI/src/Components/`
- Blade шаблоны: `/vendor/moonshine/moonshine/src/UI/resources/views/`
- Иконки: `/vendor/moonshine/moonshine/src/UI/resources/views/icons/`

## Чеклист создания новой страницы

- [ ] Создать класс страницы (`extends Page`)
- [ ] Указать Layout (`GuestLayout` для публичных)
- [ ] Реализовать метод `components()`
- [ ] Добавить роут в `routes/web.php`
- [ ] Протестировать рендеринг
- [ ] Добавить обработку данных из БД (если нужно)
- [ ] Настроить формы и валидацию (если нужно)

## Примеры использования

### Простая страница с текстом
```php
return [
    Box::make('Заголовок', [
        Heading::make('Текст', 2),
        Text::make('Описание')->readonly(),
    ]),
];
```

### Страница с формой
```php
return [
    Box::make('Форма', [
        FormBuilder::make(
            action: route('submit'),
            method: FormMethod::POST,
            fields: [
                Text::make('Имя', 'name')->required(),
            ]
        )->buttons([
            ActionButton::make('Отправить')
                ->primary()
                ->customAttributes(['type' => 'submit']),
        ]),
    ]),
];
```

### Страница с навигацией
```php
return [
    Box::make('Навигация', [
        Flex::make(
            components: [
                Link::make(route('page1'), 'Страница 1')->icon('home'),
                Link::make(route('page2'), 'Страница 2')->icon('users'),
            ],
            justifyAlign: 'between'
        ),
    ]),
];
```

---

**Дата создания:** 2025-01-XX  
**Версия MoonShine:** 4.0  
**Версия Laravel:** 12.0

