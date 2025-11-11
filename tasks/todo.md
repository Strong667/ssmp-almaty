## План обзора проекта (2025-11-11)

- [x] Собрать ключевые артефакты (маршруты, контроллеры, модели, ресурсы MoonShine)
- [x] Разобрать фронтенд-шаблоны и компоненты
- [ ] Проанализировать миграции и структуру данных
- [ ] Сформировать описание назначения проекта и основных функций
- [ ] Подготовить обзор возможностей MoonShine-админки

## План по главной странице

- [ ] Сформировать минимально необходимую структуру данных главной страницы (название, описания секций, контакты, блоки «О нас», «Администрация», «График приёма» и др.) и согласовать с бэком MoonShine.
- [ ] Создать миграцию и модель `LandingPage` с заполнителями и кастами для сложных полей.
- [ ] Реализовать сервис `LandingPageService` для чтения данных модели с соблюдением принципов SOLID.
- [ ] Подготовить контроллер/маршрут для выдачи данных главной страницы на фронт.
- [ ] Сверстать стартовый Blade-шаблон главной страницы на основе новой модели данных.

## Текущая структура проекта

ssmp-moonshine/
├── app/                               // PHP код приложения
│   ├── Http/Controllers/Frontend/HomeController.php   // контроллер главной страницы, тянет изображения и медиа
│   ├── Models/{Setting.php, User.php}                 // Eloquent-модели (настройки, пользователи)
│   └── MoonShine/                                     // кастомизация MoonShine-админки
│       ├── Layouts/MoonShineLayout.php                // макет панели управления
│       ├── Pages/Dashboard.php                        // дашборд MoonShine
│       └── Resources/
│           ├── MoonShineUserResource.php              // CRUD для админ-пользователей
│           ├── MoonShineUserRoleResource.php          // управление ролями MoonShine
│           └── SettingResource.php                    // галерея изображений главной
├── config/filesystems.php              // конфиг дисков: публичный корень /storage
├── database/migrations/                // миграции БД
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 0001_01_01_000002_create_jobs_table.php
│   ├── 2020_10_04_115514_create_moonshine_roles_table.php
│   ├── 2020_10_05_173148_create_moonshine_tables.php
│   ├── 2025_11_10_144815_create_notifications_table.php
│   └── 2025_11_10_152732_create_settings_table.php
├── public/slujba.png                   // логотип для хедера
├── resources/
│   ├── css/app.css                     // глобальные стили Vite/Tailwind
│   ├── js/{app.js, bootstrap.js}       // JS-энтрипойнты (Vite)
│   └── views/                          // Blade-шаблоны фронтенда
│       ├── frontend/
│       │   ├── components/{footer.blade.php, header.blade.php} // повторно используемые куски
│       │   ├── layouts/app.blade.php   // общий каркас страниц сайта
│       │   └── home.blade.php          // главная страница с картой, видео и галереей
│       └── welcome.blade.php           // стандартная заглушка Laravel
├── routes/web.php                      // веб-маршруты (главная и т.д.)
└── tasks/todo.md                       // текущий план/заметки

## Review

- Обновлён `resources/views/frontend/layouts/app.blade.php`: у тега `body` обнулён margin, чтобы фон хедера тянулся во всю ширину.
- Файл `slujba.png` перенесён в `public/slujba.png`, чтобы можно было подгружать логотип из Blade-шаблонов.
- Подключён Bootstrap 5.3.3 и Bootstrap Icons через CDN в `resources/views/frontend/layouts/app.blade.php`, чтобы использовать готовые UI-компоненты.
- Полностью переработан `resources/views/frontend/components/header.blade.php`: задействованы Bootstrap-компоненты (navbar, grid, формы), добавлены иконки Bootstrap Icons; в шапке оставлен только крупный логотип, селектор языка и поиск, навигация — через collapse.
- Обновлён `resources/views/frontend/components/footer.blade.php`: вынесены контакты (адрес, email, телефоны, call-центр) в отдельные колонки, добавлена форма подписки, использованы цвета и сетка Bootstrap.
- Обновлён `HomeController` и `frontend/home.blade.php`: вместо текста выводится сетка изображений из записей `settings`, данные сортируются по дате обновления.
- Обновлён `SettingResource`: убраны поля заголовка и описания, оставлена загрузка изображения и обновлена валидация (проверка файла/типа); админка работает как галерея, убран недоступный метод `rounded()`.
- Для галереи изображения получают корректный публичный URL через `Storage::disk('public')->url(...)`; диск `public` переопределён на относительный путь (`/storage`), кеш конфигурации очищен, чтобы браузер не обращался к `http://localhost`.
- На главной вместо сетки теперь бесконечная горизонтальная витрина: изображения дублируются, прокручиваются CSS-анимацией (останавливается при hover), адаптируются под ширину экрана; секция без фона, сверху в одной строке стоят блоки YouTube и карта одинакового размера.
- Привёл `NewsResource::beforeCreating/beforeUpdating` к сигнатуре MoonShine (`mixed $item): mixed`) и возвращаю модель после генерации slug.
- `HomeController` подгружает последние новости (`News`) с публичными URL изображений, `home.blade.php` выводит их сеткой карточек с картинкой и датой.

