@extends('frontend.layouts.app')

@section('title', 'Отделения - Список подстанций')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.breadcrumbs.departments') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Substations List Section -->
    <section class="substations-list section">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h1 class="section-title">ОТДЕЛЕНИЯ</h1>
                <p class="section-subtitle">Список всех подстанций скорой медицинской помощи</p>
            </div>

            @if($substations->isNotEmpty())
                <div class="row gy-4">
                    @foreach($substations as $substation)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="department-card">
                                <div class="department-icon">
                                    <i class="bi bi-hospital"></i>
                                </div>
                                <div class="department-info">
                                    <h3 class="department-name">{{ $substation->localized_name }}</h3>
                                    @if($substation->localized_address || $substation->phone)
                                        <div class="department-meta">
                                            @if($substation->localized_address)
                                                <div class="department-meta-item">
                                                    <i class="bi bi-geo-alt"></i>
                                                    <span>{{ $substation->localized_address }}</span>
                                                </div>
                                            @endif
                                            @if($substation->phone)
                                                <div class="department-meta-item">
                                                    <i class="bi bi-telephone"></i>
                                                    <a href="tel:{{ $substation->phone }}">{{ $substation->phone }}</a>
                                                </div>
                                            @endif
                                            @if($substation->employees_count)
                                                <div class="department-meta-item">
                                                    <i class="bi bi-people"></i>
                                                    <span>{{ $substation->employees_count }} {{ $substation->employees_count == 1 ? 'сотрудник' : ($substation->employees_count < 5 ? 'сотрудника' : 'сотрудников') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <a href="{{ route('substations.show', $substation->id) }}" class="department-link">
                                        Посмотреть сотрудников <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i>
                    <p class="mb-0">Подстанции пока не добавлены</p>
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
            color: #0d9488;
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

        /* Substations List Section */
        .substations-list {
            padding: 60px 0;
            background: #fff;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: #2c4964;
            margin: 0 0 15px 0;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
        }

        .section-subtitle {
            font-size: 18px;
            color: #6c757d;
            margin: 0;
        }

        /* Department Cards */
        .department-card {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .department-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle, rgba(0,0,0,0.05) 1px, transparent 1px);
            background-size: 12px 12px;
            opacity: 0.3;
            pointer-events: none;
        }

        .department-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        .department-icon {
            flex-shrink: 0;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFC107;
            border-radius: 12px;
            position: relative;
            z-index: 1;
        }

        .department-icon i {
            font-size: 32px;
            color: #fff;
        }

        .department-info {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .department-name {
            font-size: 18px;
            font-weight: 700;
            color: #2c4964;
            margin: 0 0 12px 0;
            line-height: 1.4;
            font-family: "Montserrat", sans-serif;
        }

        .department-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #4b5563;
        }

        .department-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .department-meta-item i {
            font-size: 16px;
            color: #FFC107;
            margin-top: 2px;
        }

        .department-meta-item a {
            color: inherit;
            text-decoration: none;
        }

        .department-meta-item a:hover {
            text-decoration: underline;
        }

        .department-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(60, 60, 65, 1);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .department-link:hover {
            color: rgba(50, 50, 55, 1);
            gap: 12px;
        }

        .department-link i {
            transition: transform 0.3s ease;
        }

        .department-link:hover i {
            transform: translateX(5px);
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

        /* Dark Theme */
        [data-theme="dark"] .breadcrumbs-section {
            background: #1a1a1a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .breadcrumb-item a {
            color: #adb5bd;
        }

        [data-theme="dark"] .breadcrumb-item a:hover {
            color: #0d9488;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .substations-list {
            background: #1a1a1a;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-subtitle {
            color: #adb5bd;
        }

        [data-theme="dark"] .department-card {
            background: #333333;
        }

        [data-theme="dark"] .department-card:hover {
            background: #3a3a3a;
        }

        [data-theme="dark"] .department-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .department-meta {
            color: #cbd5f5;
        }

        [data-theme="dark"] .department-meta-item i {
            color: #FFC107;
        }

        [data-theme="dark"] .alert {
            background: #1a3a4a;
            border-color: #2a5a6a;
            color: #b0d4ff;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .section-title {
                font-size: 28px;
            }

            .section-subtitle {
                font-size: 16px;
            }
        }
    </style>
    @endpush
@endsection

