<header id="header" class="fixed-top">
    <!-- Первый слой: Социальные сети, контакты, тема, локализация -->
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center g-0">
                <div class="col-md-9">
                    <div class="header-main-content">
                        <div class="header-social">
                            <a href="#" target="_blank" aria-label="Instagram" class="social-link">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" target="_blank" aria-label="Facebook" class="social-link">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                        <div class="header-contacts">
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>050000, Қазахстан Республикасы, Алматы қаласы, Алмалы ауданы, Қазыбек би көшесі, 115</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Тел.: 103</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>+7 (727) 279-46-14</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>+7 (727) 300-05-05</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill"></i>
                                <a href="mailto:Kgpssmp@ssmp-almaty.kz">Kgpssmp@ssmp-almaty.kz</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <div class="header-top-right">
                        <button id="theme-toggle" class="theme-toggle-btn" aria-label="Переключить тему">
                            <i class="bi bi-sun-fill theme-icon-light"></i>
                            <i class="bi bi-moon-fill theme-icon-dark"></i>
                        </button>
                        <div class="language-switcher">
                            <select id="language-select" class="language-select form-select form-select-sm">
                                <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>Рус</option>
                                <option value="kk" {{ app()->getLocale() === 'kk' ? 'selected' : '' }}>Қаз</option>
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
                            <h1 class="logo-title">{{ __('frontend.header.logo_title') }}</h1>
                            <p class="logo-subtitle">{{ __('frontend.header.logo_subtitle') }}</p>
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
                                {{ __('frontend.header.home') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.administration', 'about.schedule', 'about.structure', 'about.ethical-code', 'about.income-expense', 'about.vacancy-employment', 'about.documents', 'about.activity-sphere') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.about_us') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.administration') ? ' active' : '' }}" href="{{ route('about.administration') }}">{{ __('frontend.menu.administration') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.schedule') ? ' active' : '' }}" href="{{ route('about.schedule') }}">{{ __('frontend.menu.schedule') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.structure') ? ' active' : '' }}" href="{{ route('about.structure') }}">{{ __('frontend.menu.structure') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.ethical-code') ? ' active' : '' }}" href="{{ route('about.ethical-code') }}">{{ __('frontend.menu.ethical_code') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.income-expense') ? ' active' : '' }}" href="{{ route('about.income-expense') }}">{{ __('frontend.menu.income_expense') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.vacancy-employment') ? ' active' : '' }}" href="{{ route('about.vacancy-employment') }}">{{ __('frontend.menu.vacancy') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.documents') ? ' active' : '' }}" href="{{ route('about.documents') }}">{{ __('frontend.menu.documents') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.activity-sphere') ? ' active' : '' }}" href="{{ route('about.activity-sphere') }}">{{ __('frontend.menu.activity_sphere') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.procurement-plan', 'about.announcements', 'about.protocols') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.procurement') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.procurement-plan') ? ' active' : '' }}" href="{{ route('about.procurement-plan') }}">{{ __('frontend.menu.procurement_plan') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.announcements') ? ' active' : '' }}" href="{{ route('about.announcements') }}">{{ __('frontend.menu.announcements') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.protocols') ? ' active' : '' }}" href="{{ route('about.protocols') }}">{{ __('frontend.menu.protocols') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.medical-help-for-foreigners', 'about.legal-framework', 'about.emergency-service-rules', 'about.social-insurance', 'about.rubric-for-population') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.residents') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.medical-help-for-foreigners') ? ' active' : '' }}" href="{{ route('about.medical-help-for-foreigners') }}">{{ __('frontend.menu.medical_help_foreigners') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.legal-framework') ? ' active' : '' }}" href="{{ route('about.legal-framework') }}">{{ __('frontend.menu.legal_framework') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.emergency-service-rules') ? ' active' : '' }}" href="{{ route('about.emergency-service-rules') }}">{{ __('frontend.menu.emergency_service_rules') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.social-insurance') ? ' active' : '' }}" href="{{ route('about.social-insurance') }}">{{ __('frontend.menu.social_insurance') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.rubric-for-population') ? ' active' : '' }}" href="{{ route('about.rubric-for-population') }}">{{ __('frontend.menu.rubric_for_population') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.registry-of-state-services', 'about.state-service-standards', 'about.state-service-regulations', 'about.state-services') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.state_services') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-services') ? ' active' : '' }}" href="{{ route('about.state-services') }}">{{ __('frontend.menu.state_services') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.registry-of-state-services') ? ' active' : '' }}" href="{{ route('about.registry-of-state-services') }}">{{ __('frontend.menu.registry_state_services') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-service-standards') ? ' active' : '' }}" href="{{ route('about.state-service-standards') }}">{{ __('frontend.menu.state_service_standards') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-service-regulations') ? ' active' : '' }}" href="{{ route('about.state-service-regulations') }}">{{ __('frontend.menu.state_service_regulations') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.state-flag', 'about.state-emblem', 'about.state-anthem') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.state_symbols') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-flag') ? ' active' : '' }}" href="{{ route('about.state-flag') }}">{{ __('frontend.menu.state_flag') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-emblem') ? ' active' : '' }}" href="{{ route('about.state-emblem') }}">{{ __('frontend.menu.state_emblem') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.state-anthem') ? ' active' : '' }}" href="{{ route('about.state-anthem') }}">{{ __('frontend.menu.state_anthem') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('about.paid-services') ? ' active' : '' }}" href="{{ route('about.paid-services') }}">
                                {{ __('frontend.header.paid_services') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.compliance-officer-plan', 'about.corruption-risk-analysis', 'about.internal-regulations') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.compliance_service') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.compliance-officer-plan') ? ' active' : '' }}" href="{{ route('about.compliance-officer-plan') }}">{{ __('frontend.menu.compliance_officer_plan') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-analysis') ? ' active' : '' }}" href="{{ route('about.corruption-risk-analysis') }}">{{ __('frontend.menu.corruption_risk_analysis') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.internal-regulations') ? ' active' : '' }}" href="{{ route('about.internal-regulations') }}">{{ __('frontend.menu.internal_regulations') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle{{ request()->routeIs('about.corruption-risk-positions', 'about.corruption-risk-list', 'about.corruption-risk-map') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('frontend.menu.corruption_map') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-positions') ? ' active' : '' }}" href="{{ route('about.corruption-risk-positions') }}">{{ __('frontend.menu.corruption_risk_positions') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-list') ? ' active' : '' }}" href="{{ route('about.corruption-risk-list') }}">{{ __('frontend.menu.corruption_risk_list') }}</a></li>
                                <li><a class="dropdown-item{{ request()->routeIs('about.corruption-risk-map') ? ' active' : '' }}" href="{{ route('about.corruption-risk-map') }}">{{ __('frontend.menu.corruption_risk_map') }}</a></li>
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
                            <span>{!! __('frontend.quick_links.director_blog') !!}</span>
                        </a>
                        <a href="{{ route('news.list') }}" class="quick-link-btn">
                            <i class="bi bi-newspaper"></i>
                            <span>{{ __('frontend.quick_links.news') }}</span>
                        </a>
                        <a href="{{ route('anticorruption.show') }}" class="quick-link-btn">
                            <i class="bi bi-shield-check"></i>
                            <span>{{ __('frontend.quick_links.anticorruption') }}</span>
                        </a>
                        <a href="{{ route('healthy-lifestyle.show') }}" class="quick-link-btn">
                            <i class="bi bi-heart-pulse"></i>
                            <span>{{ __('frontend.quick_links.healthy_lifestyle') }}</span>
                        </a>
                        <a href="{{ route('mission-of-emergency-service.show') }}" class="quick-link-btn">
                            <i class="bi bi-bullseye"></i>
                            <span>{!! __('frontend.quick_links.mission_emergency') !!}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</header>
