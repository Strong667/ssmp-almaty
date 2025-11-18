@extends('frontend.layouts.app')

@section('title', __('frontend.home.title'))

@section('content')
    <!-- Departments Section with Tabs -->
    <section id="departments" class="departments section">
        <div class="container" data-aos="fade-up">
            <div class="departments-header">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs departments-tabs" id="departmentsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="substations-tab" data-bs-toggle="tab" data-bs-target="#substations" type="button" role="tab" aria-controls="substations" aria-selected="true">
                            {{ __('frontend.home.substations') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab" aria-controls="map" aria-selected="false">
                            {{ __('frontend.home.map') }}
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content" id="departmentsTabContent">
                <!-- Substations Tab -->
                <div class="tab-pane fade show active" id="substations" role="tabpanel" aria-labelledby="substations-tab">
                    <div class="departments-content">
                        @if(isset($substations) && $substations->isNotEmpty())
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
                                                    </div>
                                                @endif
                                                <a href="{{ route('substations.show', $substation->id) }}" class="department-link">
                                                    {{ __('frontend.home.view_employees') }} <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info text-center" role="alert">
                                {{ __('frontend.home.no_substations') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Map Tab -->
                <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                    <div class="departments-content">
                        <div class="map-container">
                            <iframe
                                src="https://yandex.ru/map-widget/v1/?um=constructor%3A984a0c4f628d41f0563e1e4becea1dd9bfe4ad7ec66d31d1ad0418b2232d4e74&source=constructor"
                                width="100%"
                                height="600"
                                style="border:0; border-radius: 10px;"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    @if($news->isNotEmpty())
        <section id="news" class="news section">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    @foreach($news as $article)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="news-box">
                                @if($article->image_url)
                                    <div class="news-img">
                                        <img src="{{ $article->image_url }}" alt="{{ $article->localized_title }}" class="img-fluid">
                                    </div>
                                @endif
                                <div class="news-content">
                                    <h3 class="news-title">{{ $article->localized_title }}</h3>
                                    <p class="news-date">{{ $article->display_date }}</p>
                                    <a href="{{ route('news.detail', $article->slug) }}" class="read-more">
                                        <span>{{ __('frontend.home.read_news') }}</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Media Section -->
    <section id="media" class="media section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="media-embed">
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://www.youtube.com/embed/videoseries?list=PLsaGgmCCSu8VucnlqRDRA-637FOrsBy1o"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="media-embed">
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://www.youtube.com/embed/IOOHZe2NMWY"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="media-embed">
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://www.youtube.com/embed/bOja5HHLs6k"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="media-embed">
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://www.youtube.com/embed/au0LFE51JJk"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    @if($images->isNotEmpty())
        <section id="gallery" class="gallery section">
            <div class="container" data-aos="fade-up">
                <div class="gallery-wrapper">
                    <div class="gallery-carousel">
                        @foreach($images->merge($images)->merge($images) as $index => $item)
                            <div class="gallery-item">
                                <img src="{{ $item['url'] }}" alt="Изображение галереи #{{ ($index % $images->count()) + 1 }}" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @push('styles')
    <style>
        /* Departments Section with Tabs */
        .departments {
            padding: 80px 0;
            position: relative;
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .departments::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(240, 249, 255, 0.85);
            z-index: 0;
        }

        .departments .container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
        }

        .departments-header {
            margin-bottom: 0;
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        .departments-tabs {
            border-bottom: none;
            gap: 8px;
            background: rgba(255, 255, 255, 0.96);
            padding: 6px;
            border-radius: 9999px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.14);
        }

        .departments-tabs .nav-item {
            margin-bottom: 0;
        }

        .departments-tabs .nav-link {
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            color: #212529;
            background: transparent;
            border: none;
            border-radius: 9999px;
            text-transform: uppercase;
            text-shadow: none;
            box-shadow: none;
        }

        .departments-tabs .nav-link:hover {
            color: #212529;
            background: transparent;
            text-shadow: none;
            box-shadow: none;
        }

        .departments-tabs .nav-link.active {
            color: #212529;
            background: #FFC107;
            font-weight: 700;
            text-shadow: none;
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.45);
        }

        .departments-content {
            background: rgba(255, 255, 255, 0.96);
            padding: 36px 40px 40px;
            border-radius: 18px;
            min-height: 420px;
            margin-top: -1px;
            position: relative;
            z-index: 1;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.16);
            border: 1px solid rgba(148, 163, 184, 0.35);
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

        .map-container {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .departments-tabs {
            background: rgba(15, 23, 42, 0.96);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.75);
        }

        [data-theme="dark"] .departments-tabs .nav-link {
            color: #e0e0e0;
            text-shadow: none;
            box-shadow: none;
        }

        [data-theme="dark"] .departments-tabs .nav-link:hover {
            color: #e0e0e0;
            background: transparent;
            text-shadow: none;
            box-shadow: none;
        }

        [data-theme="dark"] .departments-tabs .nav-link.active {
            color: #212529;
            background: #FFC107;
            border-bottom-color: #FFC107;
            text-shadow: none;
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.45);
        }

        [data-theme="dark"] .departments-content {
            background: rgba(17, 24, 39, 0.96);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.7);
            border-color: rgba(55, 65, 81, 0.8);
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

        /* News Section */
        .news {
            padding: 80px 0;
            background: linear-gradient(180deg, #f9fafb 0%, #eef2ff 100%);
        }

        .section-header {
            text-align: center;
            padding-bottom: 40px;
        }

        .section-header h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c4964;
        }

        .section-header p {
            margin: 0;
            color: #6c757d;
            font-size: 18px;
        }

        .news-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .news-img {
            overflow: hidden;
            height: 250px;
        }

        .news-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .news-box:hover .news-img img {
            transform: scale(1.1);
        }

        .news-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 15px 0;
            color: #2c4964;
            line-height: 1.4;
        }

        .news-date {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            color: #333333;
            text-decoration: none;
            font-weight: 500;
            margin-top: auto;
            font-family: "Montserrat", sans-serif;
        }

        .read-more:hover {
            color: #555555;
        }

        .read-more i {
            margin-left: 5px;
            transition: 0.3s;
        }

        .read-more:hover i {
            transform: translateX(5px);
        }

        /* Media Section */
        .media {
            padding: 80px 0;
            position: relative;
            background-image: url('{{ asset("72_main.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .media::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(240, 249, 255, 0.88);
            z-index: 0;
        }

        .media-full h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #2c4964;
        }

        .media-embed {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
            z-index: 1;
        }

        .media-embed iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Gallery Section */
        .gallery {
            padding: 80px 0;
            background: #fdfdfd;
        }

        .gallery-wrapper {
            overflow: hidden;
            padding: 20px 0;
            position: relative;
        }

        .gallery-wrapper:hover .gallery-carousel {
            animation-play-state: paused;
        }

        .gallery-carousel {
            display: flex;
            gap: 20px;
            width: fit-content;
            animation: scroll-gallery 60s linear infinite;
        }

        @keyframes scroll-gallery {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-33.333%);
            }
        }

        .gallery-item {
            flex: 0 0 auto;
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Dark Theme for Home Page Sections */
        [data-theme="dark"] .news {
            background: radial-gradient(circle at top, #1f2937 0, #020617 60%);
        }

        [data-theme="dark"] .news-box {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .news-box:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .news-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .news-date {
            color: #b0b0b0;
        }

        [data-theme="dark"] .read-more {
            color: #cccccc;
        }

        [data-theme="dark"] .read-more:hover {
            color: #e0e0e0;
        }

        [data-theme="dark"] .departments::before {
            background: rgba(15, 23, 42, 0.9);
        }

        [data-theme="dark"] .media::before {
            background: rgba(15, 23, 42, 0.9);
        }

        [data-theme="dark"] .gallery {
            background: #020617;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .section-header h2 {
                font-size: 28px;
            }

            .gallery-item {
                width: 100px;
                height: 100px;
            }
        }
    </style>
    @endpush

@endsection
