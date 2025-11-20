@extends('frontend.layouts.app')

@section('title', 'ЗОЖ')

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('frontend.breadcrumbs.home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> >> {{ __('frontend.quick_links.healthy_lifestyle') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Healthy Lifestyle Section -->
    <section class="healthy-lifestyle section">
        <div class="container">

            @if($images->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="slider-wrapper">
                            <div class="slider-container">
                                @foreach($images as $index => $image)
                                    <div class="slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                                        <img src="{{ $image->image_url }}" alt="ЗОЖ" class="slide-image img-fluid">
                                    </div>
                                @endforeach
                            </div>

                            @if($images->count() > 1)
                                <div class="slider-controls">
                                    <button class="slider-btn prev-btn" id="prevBtn" aria-label="Предыдущее изображение">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="slider-btn next-btn" id="nextBtn" aria-label="Следующее изображение">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>

                                <div class="slider-indicators">
                                    @foreach($images as $index => $image)
                                        <button class="indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}" aria-label="Перейти к слайду {{ $index + 1 }}"></button>
                                    @endforeach
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
                            <p class="mb-0">Изображения ЗОЖ пока не добавлены</p>
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
        /* Убираем стандартный разделитель Bootstrap */
        .breadcrumb-item + .breadcrumb-item::before {
            display: none !important;
            content: none !important;
        }
        /* Добавляем отступ после >> */
        .breadcrumb-item:not(:first-child) {
            margin-left: 8px;
        }



        .breadcrumb-item i {
            font-size: 16px;
        }

        /* Healthy Lifestyle Section */
        .healthy-lifestyle {
            padding: 40px 0;
            background: #fff;
        }

        .slider-wrapper {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        .slider-container {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            border-radius: 8px;
            background: #fff;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .slide.active {
            opacity: 1;
            z-index: 1;
        }

        .slide-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
        }

        .slider-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 10;
            pointer-events: none;
        }

        .slider-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #FFC107;
            color: #FFC107;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            pointer-events: all;
            font-size: 24px;
        }

        .slider-btn:hover {
            background: #FFC107;
            color: #fff;
        }

        .slider-indicators {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            z-index: 10;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #FFC107;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
        }

        .indicator.active {
            background: #FFC107;
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
        /* Убираем стандартный разделитель Bootstrap */
        .breadcrumb-item + .breadcrumb-item::before {
            display: none !important;
            content: none !important;
        }
        /* Добавляем отступ после >> */
        .breadcrumb-item:not(:first-child) {
            margin-left: 8px;
        }


        [data-theme="dark"] .healthy-lifestyle {
            background: #1a1a1a;
        }

        [data-theme="dark"] .slider-container {
            background: #2a2a2a;
        }

        [data-theme="dark"] .slider-btn {
            background: rgba(42, 42, 42, 0.9);
            border-color: #FFC107;
        }

        @media (max-width: 991px) {
            .slider-container {
                height: 400px;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const indicators = document.querySelectorAll('.indicator');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));

                if (slides[index]) {
                    slides[index].classList.add('active');
                    if (indicators[index]) {
                        indicators[index].classList.add('active');
                    }
                }
                currentSlide = index;
            }

            function nextSlide() {
                const next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }

            function prevSlide() {
                const prev = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(prev);
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', nextSlide);
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', prevSlide);
            }

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Автоматическое переключение (опционально, можно убрать)
            // setInterval(nextSlide, 5000);
        });
    </script>
    @endpush
@endsection

