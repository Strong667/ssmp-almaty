@extends('frontend.layouts.app')

@section('title', $news->title)

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('news.list') }}">Новости</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($news->title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- News Detail Section -->
    <section class="news-detail-section section">
        <div class="container">
            <article class="news-detail">
                @if($news->image_url)
                    <div class="news-detail-img">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="img-fluid">
                    </div>
                @endif
                
                <header class="news-detail-header">
                    <h1 class="news-detail-title">{{ $news->title }}</h1>
                    <div class="news-detail-date">
                        <i class="bi bi-calendar"></i> {{ $news->display_date }}
                    </div>
                </header>

                <div class="news-detail-content">
                    {!! $news->description !!}
                </div>

                @if($news->video_url)
                    <div class="news-detail-video">
                        <iframe
                            width="100%"
                            height="500"
                            src="{{ $news->video_url }}"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            </article>
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

        /* News Detail Section */
        .news-detail-section {
            padding: 40px 0;
            background: #fff;
        }

        .news-detail {
            max-width: 900px;
            margin: 0 auto;
        }

        .news-detail-img {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .news-detail-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .news-detail-header {
            margin-bottom: 25px;
        }

        .news-detail-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #212529;
            font-family: "Montserrat", sans-serif;
        }

        .news-detail-date {
            color: #6c757d;
            font-size: 15px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .news-detail-date i {
            color: #0d9488;
        }

        .news-detail-content {
            font-size: 16px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 30px;
        }

        .news-detail-video {
            margin: 30px 0;
            border-radius: 8px;
            overflow: hidden;
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

        [data-theme="dark"] .news-detail-section {
            background: #1a1a1a;
        }

        [data-theme="dark"] .news-detail-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-detail-content {
            color: #adb5bd;
        }

        [data-theme="dark"] .news-detail-date {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .news-detail-title {
                font-size: 24px;
            }

            .news-detail-content {
                font-size: 15px;
            }
        }
    </style>
    @endpush
@endsection

