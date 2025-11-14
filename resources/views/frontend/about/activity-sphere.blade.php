@extends('frontend.layouts.app')

@section('title', 'Сфера деятельности')

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
                    <li class="breadcrumb-item active" aria-current="page">Сфера деятельности</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Activity Sphere Section -->
    <section class="activity-sphere section">
        <div class="container">
            @if($activitySphere)
                <div class="row">
                    <div class="col-12">
                        @if($activitySphere->general_info)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                    <h3 class="info-title">Общая информация</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->general_info !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->mission)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-bullseye"></i>
                                    </div>
                                    <h3 class="info-title">Миссия</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->mission !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->goal)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <h3 class="info-title">Цель</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->goal !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->history)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <h3 class="info-title">История</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->history !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация о сфере деятельности пока не добавлена</p>
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

        /* Activity Sphere Section */
        .activity-sphere {
            padding: 40px 0;
            background: #fff;
        }

        .info-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .info-card:last-child {
            margin-bottom: 0;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #0d9488;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
        }

        .info-title {
            font-size: 24px;
            font-weight: 600;
            color: #212529;
            margin: 0;
            font-family: "Montserrat", sans-serif;
        }

        .info-content {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
        }

        .info-content p {
            margin-bottom: 15px;
        }

        .info-content p:last-child {
            margin-bottom: 0;
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

        [data-theme="dark"] .activity-sphere {
            background: #1a1a1a;
        }

        [data-theme="dark"] .info-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .info-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .info-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .info-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .info-content {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 20px;
            }

            .info-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .info-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 20px;
            }

            .info-title {
                font-size: 20px;
            }
        }
    </style>
    @endpush
@endsection

