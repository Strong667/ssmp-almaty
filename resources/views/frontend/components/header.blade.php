<header id="header" class="fixed-top">
    <!-- Первый слой: Социальные сети, тема, локализация -->
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center g-0">
                <div class="col-md-6">
                    <div class="social-links">
                        <a href="#" target="_blank" aria-label="Instagram" class="social-link">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" target="_blank" aria-label="Facebook" class="social-link">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="header-top-right">
                        <button id="theme-toggle" class="theme-toggle-btn" aria-label="Переключить тему">
                            <i class="bi bi-sun-fill theme-icon-light"></i>
                            <i class="bi bi-moon-fill theme-icon-dark"></i>
                        </button>
                        <div class="language-switcher">
                            <select id="language-select" class="language-select form-select form-select-sm">
                                <option value="ru" selected>Рус</option>
                                <option value="kk">Қаз</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Второй слой: Логотип с текстом -->
    <div class="header-middle">
        <div class="container-fluid">
            <div class="row align-items-center g-0">
                <div class="col-12">
                    <a href="{{ route('home') }}" class="logo-link">
                        <div class="logo-wrapper">
                            <img src="{{ asset('slujba.png') }}" alt="Логотип" class="logo-img">
                        </div>
                        <div class="logo-text">
                            <h1 class="logo-title">Служба скорой медицинской помощи</h1>
                            <p class="logo-subtitle">г. Алматы</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Третий слой: Меню навигации -->
    <div class="header-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav w-100 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">
                                Главная
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.administration', 'about.schedule', 'about.structure', 'about.mission', 'about.ethical-code', 'about.income-expense', 'about.vacancy-employment', 'about.documents', 'about.activity-sphere') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                О нас
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.administration') ? ' active' : '' }}" href="{{ route('about.administration') }}">Администрация</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.schedule') ? ' active' : '' }}" href="{{ route('about.schedule') }}">График приёма граждан</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.structure') ? ' active' : '' }}" href="{{ route('about.structure') }}">Структура</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.mission') ? ' active' : '' }}" href="{{ route('about.mission') }}">Миссия и ценности</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.ethical-code') ? ' active' : '' }}" href="{{ route('about.ethical-code') }}">Этический кодекс</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.income-expense') ? ' active' : '' }}" href="{{ route('about.income-expense') }}">Отчёты о доходах и расходах</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.vacancy-employment') ? ' active' : '' }}" href="{{ route('about.vacancy-employment') }}">Вакансия</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.documents') ? ' active' : '' }}" href="{{ route('about.documents') }}">Документы</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.activity-sphere') ? ' active' : '' }}" href="{{ route('about.activity-sphere') }}">Сфера деятельности</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.procurement-plan', 'about.announcements', 'about.protocols') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Государственные закупки
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.procurement-plan') ? ' active' : '' }}" href="{{ route('about.procurement-plan') }}">План государственных закупок</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.announcements') ? ' active' : '' }}" href="{{ route('about.announcements') }}">Объявления</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.protocols') ? ' active' : '' }}" href="{{ route('about.protocols') }}">Протоколы</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.medical-help-for-foreigners', 'about.legal-framework', 'about.emergency-service-rules', 'about.social-insurance', 'about.rubric-for-population') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Жителям Алматы
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.medical-help-for-foreigners') ? ' active' : '' }}" href="{{ route('about.medical-help-for-foreigners') }}">Оказание медицинской помощи иностранному гражданину в РК</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.legal-framework') ? ' active' : '' }}" href="{{ route('about.legal-framework') }}">Нормативно-правовая база</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.emergency-service-rules') ? ' active' : '' }}" href="{{ route('about.emergency-service-rules') }}">Правила обращения в службу скорой медицинской помощи</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.social-insurance') ? ' active' : '' }}" href="{{ route('about.social-insurance') }}">Обязательное социальное медицинское страхование</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.rubric-for-population') ? ' active' : '' }}" href="{{ route('about.rubric-for-population') }}">Рубрика для населения</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.registry-of-state-services', 'about.state-service-standards', 'about.state-service-regulations', 'about.state-services') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Государственные услуги
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-services') ? ' active' : '' }}" href="{{ route('about.state-services') }}">Государственные услуги</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.registry-of-state-services') ? ' active' : '' }}" href="{{ route('about.registry-of-state-services') }}">Реестр государственных услуг</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-service-standards') ? ' active' : '' }}" href="{{ route('about.state-service-standards') }}">Стандарты государственных услуг</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-service-regulations') ? ' active' : '' }}" href="{{ route('about.state-service-regulations') }}">Регламенты государственных услуг</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.state-flag', 'about.state-emblem', 'about.state-anthem') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Государственные символы
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-flag') ? ' active' : '' }}" href="{{ route('about.state-flag') }}">Государственный Флаг</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-emblem') ? ' active' : '' }}" href="{{ route('about.state-emblem') }}">Государственный Герб</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-anthem') ? ' active' : '' }}" href="{{ route('about.state-anthem') }}">Государственный Гимн</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('about.paid-services') ? ' active' : '' }}" href="{{ route('about.paid-services') }}">
                                Платные услуги
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.compliance-officer-plan', 'about.corruption-risk-analysis', 'about.internal-regulations') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Комплаенс служба
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.compliance-officer-plan') ? ' active' : '' }}" href="{{ route('about.compliance-officer-plan') }}">План работы комплаенс офицера 2024г</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-analysis') ? ' active' : '' }}" href="{{ route('about.corruption-risk-analysis') }}">Внутренний анализ коррупционных рисков</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.internal-regulations') ? ' active' : '' }}" href="{{ route('about.internal-regulations') }}">Внутренние НПА</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.corruption-risk-positions', 'about.corruption-risk-list', 'about.corruption-risk-map') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Картограмма коррупции
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-positions') ? ' active' : '' }}" href="{{ route('about.corruption-risk-positions') }}">Должности, подверженные коррупционным рискам</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-list') ? ' active' : '' }}" href="{{ route('about.corruption-risk-list') }}">Перечень коррупционных рисков</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-map') ? ' active' : '' }}" href="{{ route('about.corruption-risk-map') }}">Карта коррупционных рисков</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- Четвертый слой: Быстрые кнопки (только на главной странице) -->
    @if(request()->routeIs('home'))
    <div class="header-quick-links">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-12">
                    <div class="quick-links-wrapper">
                        <a href="{{ route('director-blog.show') }}" class="quick-link-btn">
                            <i class="bi bi-file-person"></i>
                            <span>БЛОГ О ДИРЕКТОРЕ</span>
                        </a>
                        <a href="{{ route('news.list') }}" class="quick-link-btn">
                            <i class="bi bi-newspaper"></i>
                            <span>НОВОСТИ</span>
                        </a>
                        <a href="{{ route('anticorruption.show') }}" class="quick-link-btn">
                            <i class="bi bi-shield-check"></i>
                            <span>АНТИКОР</span>
                        </a>
                        <a href="{{ route('healthy-lifestyle.show') }}" class="quick-link-btn">
                            <i class="bi bi-heart-pulse"></i>
                            <span>ЗОЖ</span>
                        </a>
                        <a href="{{ route('mission-of-emergency-service.show') }}" class="quick-link-btn">
                            <i class="bi bi-bullseye"></i>
                            <span>МИССИЯ СКОРОЙ<br>ПОМОЩИ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</header>
