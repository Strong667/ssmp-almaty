@extends('frontend.layouts.app')

@section('title', 'Вакансия')

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.vacancy') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Vacancy Employment Section -->
    <section class="vacancy-employment section">
        <div class="container">
            <!-- Employment Info Section -->
            @if($employmentInfos->isNotEmpty())
                <div class="row gy-4">
                    @foreach($employmentInfos as $info)
                        <div class="col-12">
                            <div class="employment-card">
                                <div class="employment-header">
                                    <div class="employment-icon">
                                        <i class="bi bi-file-earmark-medical"></i>
                                    </div>
                                    <div class="employment-content">
                                        <h3 class="employment-title">{{ $info->localized_title }}</h3>
                                        @if($info->localized_description)
                                            <div class="employment-description">
                                                {!! $info->localized_description !!}
                                            </div>
                                        @endif
                                        @if($info->localized_file1 || $info->localized_file2 || $info->localized_file3)
                                            <div class="employment-actions">
                                                @if($info->localized_file1)
                                                    <a href="{{ route('storage.public', ['path' => $info->localized_file1]) }}" download class="employment-link">
                                                        <i class="bi bi-download"></i>
                                                        <span>{{ $info->localized_file1_name ?: 'Скачать файл 1' }}</span>
                                                    </a>
                                                @endif
                                                @if($info->localized_file2)
                                                    <a href="{{ route('storage.public', ['path' => $info->localized_file2]) }}" download class="employment-link">
                                                        <i class="bi bi-download"></i>
                                                        <span>{{ $info->localized_file2_name ?: 'Скачать файл 2' }}</span>
                                                    </a>
                                                @endif
                                                @if($info->localized_file3)
                                                    <a href="{{ route('storage.public', ['path' => $info->localized_file3]) }}" download class="employment-link">
                                                        <i class="bi bi-download"></i>
                                                        <span>{{ $info->localized_file3_name ?: 'Скачать файл 3' }}</span>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Vacancies Section -->
            @if($vacancies->isNotEmpty())
                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class="section-title">Вакансии</h2>
                    </div>
                </div>
                <div class="row gy-4 mt-2">
                    @foreach($vacancies as $vacancy)
                        <div class="col-12">
                            <div class="vacancy-card">
                                <div class="vacancy-header">
                                    <div class="vacancy-icon">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                    <div class="vacancy-content">
                                        <h3 class="vacancy-title">{{ $vacancy->localized_title }}</h3>
                                        @if($vacancy->localized_description)
                                            <div class="vacancy-description">
                                                {!! $vacancy->localized_description !!}
                                            </div>
                                        @endif
                                        @if($vacancy->localized_schedule)
                                            <div class="vacancy-detail">
                                                <i class="bi bi-clock"></i>
                                                <span><strong>{{ __('frontend.vacancy.schedule_label') }}</strong> {{ $vacancy->localized_schedule }}</span>
                                            </div>
                                        @endif
                                        @if($vacancy->contact_info)
                                            <div class="vacancy-detail">
                                                <i class="bi bi-telephone"></i>
                                                <span><strong>{{ __('frontend.vacancy.contact_info_label') }}</strong> {{ $vacancy->contact_info }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Vacancy Contact Information -->
            @if($vacancies->isNotEmpty())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="vacancy-contact-info">
                            <p class="vacancy-contact-text">{{ __('frontend.vacancy.salary_discussed') }}</p>
                            <p class="vacancy-contact-text"><strong>{{ __('frontend.vacancy.send_resume') }}</strong></p>
                            <ul class="vacancy-contact-list">
                                <li>{{ __('frontend.vacancy.to_email') }} <a href="mailto:Kgpssmp@ssmp-almaty.ru">Kgpssmp@ssmp-almaty.ru</a></li>
                                <li>{{ __('frontend.vacancy.to_whatsapp') }} <a href="tel:+77013144646">8 701 314 46 46</a></li>
                                <li>{{ __('frontend.vacancy.or_deliver') }} Казыбек би, 115.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if($employmentInfos->isEmpty() && $vacancies->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация пока не добавлена</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Breadcrumbs Section */
        .breadcrumbs-section {
            padding: 15px 0;
            background: #f8f9fa;
            border-bottom: 1px solid #e5e7eb;
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: #FFC107;
        }

        .breadcrumb-item.active {
            color: #2c4964;
            font-weight: 500;
        }

        .breadcrumb-item::after {
            content: '>';
            margin: 0 8px;
            color: #adb5bd;
        }

        .breadcrumb-item:last-child::after {
            display: none;
        }

        .breadcrumb-item i {
            font-size: 16px;
        }

        /* Vacancy Employment Section */
        .vacancy-employment {
            padding: 40px 0;
            background: #fff;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .employment-card,
        .vacancy-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .employment-card:hover,
        .vacancy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .employment-header,
        .vacancy-header {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .employment-icon,
        .vacancy-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #FFC107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .employment-content,
        .vacancy-content {
            flex-grow: 1;
        }

        .employment-title,
        .vacancy-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 15px 0;
            color: #212529;
            font-family: "Montserrat", sans-serif;
        }

        .employment-description,
        .vacancy-description {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 20px;
        }

        .vacancy-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #495057;
            margin-bottom: 10px;
        }

        .vacancy-detail:last-child {
            margin-bottom: 0;
        }

        .vacancy-detail i {
            color: #FFC107;
            font-size: 18px;
        }

        .vacancy-contact-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 30px;
            margin-top: 30px;
        }

        .vacancy-contact-text {
            font-size: 16px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 15px;
        }

        .vacancy-contact-text:last-of-type {
            margin-bottom: 10px;
        }

        .vacancy-contact-list {
            list-style: none;
            padding: 0;
            margin: 0 0 0 20px;
        }

        .vacancy-contact-list li {
            font-size: 16px;
            line-height: 1.8;
            color: #495057;
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }

        .vacancy-contact-list li:before {
            content: '•';
            position: absolute;
            left: 0;
            color: #FFC107;
            font-weight: bold;
        }

        .vacancy-contact-list li:last-child {
            margin-bottom: 0;
        }

        .vacancy-contact-list a {
            color: #FFC107;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .vacancy-contact-list a:hover {
            color: #0b7d73;
            text-decoration: underline;
        }

        .employment-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .employment-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFC107;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .employment-link:hover {
            background: #d4a000;
            color: #fff;
        }

        .employment-link-secondary {
            background: #6c757d;
        }

        .employment-link-secondary:hover {
            background: #d4a000;
        }

        .alert {
            padding: 30px;
            border-radius: 10px;
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
        }

        .alert i {
            font-size: 24px;
            margin-right: 10px;
        }

        [data-theme="dark"] .breadcrumbs-section {
            background: #1a1a1a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .breadcrumb-item a {
            color: #adb5bd;
        }

        [data-theme="dark"] .breadcrumb-item a:hover {
            color: #FFC107;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .vacancy-employment {
            background: #1a1a1a;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .employment-card,
        [data-theme="dark"] .vacancy-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .employment-card:hover,
        [data-theme="dark"] .vacancy-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .employment-title,
        [data-theme="dark"] .vacancy-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .employment-description,
        [data-theme="dark"] .vacancy-description {
            color: #adb5bd;
        }

        [data-theme="dark"] .vacancy-detail {
            color: #adb5bd;
        }

        [data-theme="dark"] .vacancy-contact-info {
            background: #2a2a2a;
        }

        [data-theme="dark"] .vacancy-contact-text {
            color: #adb5bd;
        }

        [data-theme="dark"] .vacancy-contact-list li {
            color: #adb5bd;
        }

        [data-theme="dark"] .vacancy-contact-list li:before {
            color: #FFC107;
        }

        [data-theme="dark"] .vacancy-contact-list a {
            color: #FFC107;
        }

        [data-theme="dark"] .vacancy-contact-list a:hover {
            color: #0b7d73;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 24px;
            }

            .employment-card,
            .vacancy-card {
                padding: 20px;
            }

            .employment-header,
            .vacancy-header {
                flex-direction: column;
                gap: 15px;
            }

            .employment-icon,
            .vacancy-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 18px;
            }

            .employment-title,
            .vacancy-title {
                font-size: 20px;
            }

            .employment-actions {
                flex-direction: column;
            }

            .employment-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

