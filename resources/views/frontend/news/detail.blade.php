@extends('frontend.layouts.app')

@section('title', $news->localized_title)

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
                        <a href="{{ route('news.list') }}">{{ __('frontend.header.news') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($news->localized_title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- News Detail Section -->
    <section class="news-detail-section section">
        <div class="container">
            <article class="news-detail">
                <header class="news-detail-header">
                    <h1 class="news-detail-title">{{ $news->localized_title }}</h1>
                    <div class="news-detail-date">
                        <i class="bi bi-calendar"></i> {{ $news->display_date }}
                    </div>
                </header>

                <div class="news-detail-content">
                    {!! $news->localized_description !!}
                </div>

                @if($news->images->isNotEmpty())
                    <div class="news-images-gallery">
                        @if($news->images->count() > 1)
                            <!-- Слайдшоу для нескольких изображений -->
                            <div class="news-gallery-slider" id="newsGallerySlider">
                                <div class="gallery-slides">
                                    @foreach($news->images as $index => $image)
                                        <div class="gallery-slide {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ $image->image_url }}" alt="{{ $news->localized_title }}" class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="gallery-controls">
                                    <button class="gallery-btn gallery-btn-prev" aria-label="Предыдущее изображение">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="gallery-btn gallery-btn-next" aria-label="Следующее изображение">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="gallery-counter">
                                    <span class="gallery-current">1</span> / <span class="gallery-total">{{ $news->images->count() }}</span>
                                </div>
                            </div>
                        @else
                            <!-- Одно изображение без слайдшоу -->
                            <div class="news-detail-img">
                                <img src="{{ $news->images->first()->image_url }}" alt="{{ $news->localized_title }}" class="img-fluid">
                            </div>
                        @endif
                    </div>
                @elseif($news->image_url)
                    <div class="news-detail-img">
                        <img src="{{ $news->image_url }}" alt="{{ $news->localized_title }}" class="img-fluid">
                    </div>
                @endif

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

        .news-images-gallery {
            margin: 40px 0;
        }

        .news-detail-img {
            margin-bottom: 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .news-detail-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Gallery Slider */
        .news-gallery-slider {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .gallery-slides {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .gallery-slide {
            display: none;
        }

        .gallery-slide.active {
            display: block;
        }

        .gallery-slide img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
        }

        .gallery-controls {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            pointer-events: none;
            padding: 0 10px;
        }

        .gallery-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #2c4964;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            pointer-events: all;
        }

        .gallery-btn:hover {
            background: #fff;
            color: #0d9488;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .gallery-btn:active {
            transform: scale(0.95);
        }

        .gallery-counter {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.6);
            padding: 6px 14px;
            border-radius: 20px;
            min-width: 50px;
            text-align: center;
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

        [data-theme="dark"] .gallery-btn {
            background: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        [data-theme="dark"] .gallery-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #0d9488;
        }

        @media (max-width: 991px) {
            .news-detail-title {
                font-size: 24px;
            }

            .news-detail-content {
                font-size: 15px;
            }

            .gallery-btn {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .gallery-counter {
                font-size: 14px;
                padding: 6px 12px;
            }
        }
    </style>
    @endpush

    @if($news->images->isNotEmpty() && $news->images->count() > 1)
        @push('scripts')
        <script>
            (function() {
                const slider = document.getElementById('newsGallerySlider');
                if (!slider) return;

                const slides = slider.querySelectorAll('.gallery-slide');
                const prevBtn = slider.querySelector('.gallery-btn-prev');
                const nextBtn = slider.querySelector('.gallery-btn-next');
                const currentSpan = slider.querySelector('.gallery-current');
                const totalSpan = slider.querySelector('.gallery-total');

                let currentSlide = 0;
                const totalSlides = slides.length;

                if (totalSpan) {
                    totalSpan.textContent = totalSlides;
                }

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle('active', i === index);
                    });
                    
                    if (currentSpan) {
                        currentSpan.textContent = index + 1;
                    }
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    showSlide(currentSlide);
                }

                function prevSlide() {
                    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                    showSlide(currentSlide);
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', nextSlide);
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', prevSlide);
                }

                // Поддержка клавиатуры
                document.addEventListener('keydown', function(e) {
                    if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
                        return;
                    }
                    if (e.key === 'ArrowLeft') {
                        prevSlide();
                    } else if (e.key === 'ArrowRight') {
                        nextSlide();
                    }
                });
            })();
        </script>
        @endpush
    @endif
@endsection

