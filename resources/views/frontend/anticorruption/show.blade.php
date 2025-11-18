@extends('frontend.layouts.app')

@section('title', 'Антикор')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.quick_links.anticorruption') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Anticorruption Section -->
    <section class="anticorruption section">
        <div class="container">

            @if($anticorruption)
                @if($anticorruption->headerImage)
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="header-image-wrapper">
                                <img src="{{ $anticorruption->headerImage->image_url }}" alt="{{ $anticorruption->localized_title }}" class="header-image img-fluid">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="anticorruption-content">
                            <h2 class="content-title">{{ $anticorruption->localized_title }}</h2>
                            
                            @if($anticorruption->localized_description)
                                <div class="content-section">
                                    <div class="section-content">
                                        {!! nl2br(e($anticorruption->localized_description)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($anticorruption->localized_service_tasks)
                                <div class="content-section">
                                    <h3 class="section-title">{{ __('frontend.anticorruption.service_tasks') }}</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($anticorruption->localized_service_tasks)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($anticorruption->call_center)
                                <div class="content-section">
                                    <h3 class="section-title">Call-центр</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($anticorruption->call_center)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($anticorruption->compliance_officer)
                                <div class="content-section">
                                    <h3 class="section-title">Комплаенс-офицер</h3>
                                    <div class="section-content">
                                        {!! nl2br(e($anticorruption->compliance_officer)) !!}
                                    </div>
                                </div>
                            @endif

                            @if($anticorruption->images->where('is_header', false)->isNotEmpty())
                                <div class="content-section">
                                    <div class="images-gallery">
                                        <div class="row gy-4">
                                            @foreach($anticorruption->images->where('is_header', false) as $image)
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="gallery-item">
                                                        <img src="{{ $image->image_url }}" alt="Изображение" class="img-fluid">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
                            <p class="mb-0">Информация об антикоррупции пока не добавлена</p>
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

        /* Anticorruption Section */
        .anticorruption {
            padding: 40px 0;
            background: #fff;
        }

        .header-image-wrapper {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .header-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .anticorruption-content {
            padding: 0;
        }

        .content-title {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 25px 0;
            font-family: "Montserrat", sans-serif;
        }

        .content-section {
            margin-bottom: 25px;
        }

        .content-section:last-child {
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

        .images-gallery {
            margin-top: 20px;
        }

        .gallery-item {
            border-radius: 8px;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
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

        [data-theme="dark"] .anticorruption {
            background: #1a1a1a;
        }

        [data-theme="dark"] .content-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-content {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .content-title {
                font-size: 24px;
            }
        }
    </style>
    @endpush
@endsection

