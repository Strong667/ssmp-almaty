@extends('frontend.layouts.app')

@section('title', 'Блог о директоре')

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
                    <li class="breadcrumb-item active" aria-current="page">Блог о директоре</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Director Blog Section -->
    <section class="director-blog section">
        <div class="container">

            @if($director)
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="director-photo-wrapper">
                            @if($director->photo_url)
                                <img src="{{ $director->photo_url }}" alt="{{ $director->full_name }}" class="director-photo img-fluid">
                            @else
                                <div class="director-photo-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="director-info">
                            <h2 class="director-name">{{ $director->full_name }}</h2>
                            
                            @if($director->birth_date)
                                <div class="director-detail">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Дата рождения: {{ $director->birth_date->format('d.m.Y') }}</span>
                                </div>
                            @endif

                            @if($director->personal_info)
                                <div class="director-section">
                                    <h3 class="section-title">Личная информация</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->personal_info)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->education)
                                <div class="director-section">
                                    <h3 class="section-title">Образования</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->education)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->career)
                                <div class="director-section">
                                    <h3 class="section-title">Карьера</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->career)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($director->associate_professor_ram)
                                <div class="director-section">
                                    <h3 class="section-title">Ассоциированный профессор РАМ</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($director->associate_professor_ram)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация о директоре пока не добавлена</p>
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

        /* Director Blog Section */
        .director-blog {
            padding: 40px 0;
            background: #fff;
        }

        .director-photo-wrapper {
            margin-bottom: 30px;
        }

        .director-photo {
            width: 100%;
            border-radius: 8px;
        }

        .director-photo-placeholder {
            width: 100%;
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #adb5bd;
            font-size: 120px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .director-info {
            padding: 0;
        }

        .director-name {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .director-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .director-detail i {
            color: #0d9488;
            font-size: 18px;
        }

        .director-section {
            margin-bottom: 25px;
        }

        .director-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
        }

        .section-content {
            font-size: 15px;
            color: #495057;
            line-height: 1.7;
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
            color: #0d9488;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .director-blog {
            background: #1a1a1a;
        }

        [data-theme="dark"] .director-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-detail {
            color: #adb5bd;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-content {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-photo-placeholder {
            background: #2a2a2a;
            border-color: rgba(255, 255, 255, 0.1);
            color: #495057;
        }

        @media (max-width: 991px) {
            .director-name {
                font-size: 24px;
            }

            .director-photo-wrapper {
                margin-bottom: 25px;
            }
        }
    </style>
    @endpush
@endsection

