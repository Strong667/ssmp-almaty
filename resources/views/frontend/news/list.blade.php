@extends('frontend.layouts.app')

@section('title', 'Новости')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.header.news') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- News List Section -->
    <section class="news-list section">
        <div class="container">
            @if($news->isNotEmpty())
                <div class="row gy-4">
                    @foreach($news as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="news-card">
                                @if($item->image_url)
                                    <div class="news-card-image">
                                        <a href="{{ route('news.detail', $item->slug) }}">
                                            <img src="{{ $item->image_url }}" alt="{{ $item->localized_title }}" class="img-fluid">
                                        </a>
                                    </div>
                                @endif
                                <div class="news-card-body">
                                    <div class="news-card-date">
                                        <i class="bi bi-calendar"></i> {{ $item->display_date }}
                                    </div>
                                    <h3 class="news-card-title">
                                        <a href="{{ route('news.detail', $item->slug) }}">{{ $item->localized_title }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i>
                    <p class="mb-0">{{ __('frontend.news.no_news') }}</p>
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

        /* News List Section */
        .news-list {
            padding: 40px 0;
            background: #fff;
        }

        .news-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card-image {
            width: 100%;
            overflow: hidden;
        }

        .news-card-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card-image a:hover img {
            transform: scale(1.05);
        }

        .news-card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            border-top: 1px solid #e5e7eb;
        }

        .news-card-date {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .news-card-date i {
            color: #FFC107;
        }

        .news-card-title {
            font-size: 18px;
            font-weight: 600;
            color: #212529;
            margin: 0;
            font-family: "Montserrat", sans-serif;
            flex: 1;
        }

        .news-card-title a {
            color: #212529;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .news-card-title a:hover {
            color: #FFC107;
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

        [data-theme="dark"] .news-list {
            background: #1a1a1a;
        }

        [data-theme="dark"] .news-card {
            background: #2a2a2a;
        }

        [data-theme="dark"] .news-card-title,
        [data-theme="dark"] .news-card-title a {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-card-title a:hover {
            color: #FFC107;
        }

        [data-theme="dark"] .news-card-body {
            background: #2a2a2a;
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .news-card-date {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .news-card-image img {
                height: 180px;
            }
        }
    </style>
    @endpush
@endsection

