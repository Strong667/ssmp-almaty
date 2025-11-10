## План по главной странице

- [ ] Сформировать минимально необходимую структуру данных главной страницы (название, описания секций, контакты, блоки «О нас», «Администрация», «График приёма» и др.) и согласовать с бэком MoonShine.
- [ ] Создать миграцию и модель `LandingPage` с заполнителями и кастами для сложных полей.
- [ ] Реализовать сервис `LandingPageService` для чтения данных модели с соблюдением принципов SOLID.
- [ ] Подготовить контроллер/маршрут для выдачи данных главной страницы на фронт.
- [ ] Сверстать стартовый Blade-шаблон главной страницы на основе новой модели данных.

## Текущая структура проекта

moonshine_project/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Frontend/
│   │           └── HomeController.php
│   ├── Models/
│   │   ├── Setting.php
│   │   └── User.php
│   └── MoonShine/
│       ├── Layouts/
│       ├── Pages/
│       └── Resources/
│           ├── MoonShineUserResource.php
│           ├── MoonShineUserRoleResource.php
│           └── SettingResource.php
├── database/
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       ├── 0001_01_01_000001_create_cache_table.php
│       ├── 0001_01_01_000002_create_jobs_table.php
│       ├── 2020_10_04_115514_create_moonshine_roles_table.php
│       ├── 2020_10_05_173148_create_moonshine_tables.php
│       ├── 2025_11_10_144815_create_notifications_table.php
│       └── 2025_11_10_152732_create_settings_table.php
├── resources/
│   └── views/
│       ├── frontend/
│       │   ├── components/
│       │   │   ├── footer.blade.php
│       │   │   └── header.blade.php
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   └── home.blade.php
│       └── welcome.blade.php
├── routes/
│   └── web.php
└── ...

## Review

_(будет заполнено по завершении работ)_

