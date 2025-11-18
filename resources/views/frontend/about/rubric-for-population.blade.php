@extends('frontend.layouts.app')

@section('title', 'Рубрика для населения')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.rubric_for_population') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Rubric For Population Section -->
    <section class="rubric-for-population section">
        <div class="container">
            @if($items->isNotEmpty())
                <div class="row gy-4">
                    @foreach($items as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="rubric-card">
                                <div class="rubric-image-wrapper">
                                    @if($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="rubric-image">
                                    @else
                                        <div class="rubric-image-placeholder">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="rubric-content">
                                    <h3 class="rubric-title">{{ $item->title }}</h3>
                                    <p class="rubric-date">
                                        <i class="bi bi-calendar"></i>
                                        {{ $item->created_at ? $item->created_at->format('d.m.Y') : '' }}
                                    </p>
                                    <a href="{{ route('about.rubric-for-population.detail', $item->id) }}" class="rubric-link">
                                        <span>ПОСМОТРЕТЬ</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
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

        /* Rubric For Population Section */
        .rubric-for-population {
            padding: 40px 0;
            background: #fff;
        }

        .rubric-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .rubric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .rubric-image-wrapper {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .rubric-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rubric-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 48px;
        }

        .rubric-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .rubric-title {
            font-size: 18px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
            flex-grow: 1;
        }

        .rubric-date {
            font-size: 14px;
            color: #6c757d;
            margin: 0 0 15px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .rubric-date i {
            color: #FFC107;
        }

        .rubric-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFC107;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .rubric-link:hover {
            background: #0b7d73;
            color: #fff;
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

        [data-theme="dark"] .rubric-for-population {
            background: #1a1a1a;
        }

        [data-theme="dark"] .rubric-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .rubric-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .rubric-image-wrapper {
            background: #1a1a1a;
        }

        [data-theme="dark"] .rubric-image-placeholder {
            color: #495057;
        }

        [data-theme="dark"] .rubric-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .rubric-date {
            color: #adb5bd;
        }

        @media (max-width: 768px) {
            .rubric-content {
                padding: 15px;
            }

            .rubric-title {
                font-size: 16px;
            }
        }
    </style>
    @endpush
@endsection

