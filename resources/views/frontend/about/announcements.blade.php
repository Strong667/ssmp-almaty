@extends('frontend.layouts.app')

@section('title', 'Объявления')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.announcements') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Announcements Section -->
    <section class="announcements section">
        <div class="container">
            @if($categories->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="announcementsAccordion">
                            @foreach($categories as $index => $category)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $category->id }}">
                                        <button class="accordion-button{{ $index === 0 ? '' : ' collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $category->id }}">
                                            <i class="bi bi-folder-fill"></i>
                                            <span>{{ $category->title }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse{{ $index === 0 ? ' show' : '' }}" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#announcementsAccordion">
                                        <div class="accordion-body">
                                            @if($category->announcements->isNotEmpty())
                                                <div class="announcements-list">
                                                    @foreach($category->announcements as $announcement)
                                                        <div class="announcement-item">
                                                            <div class="announcement-content">
                                                                <div class="announcement-text">
                                                                    {!! $announcement->text !!}
                                                                </div>
                                                                @if($announcement->file_url)
                                                                    <div class="announcement-actions">
                                                                        <a href="{{ $announcement->file_url }}" download class="announcement-link">
                                                                            <i class="bi bi-download"></i>
                                                                            <span>Скачать файл</span>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-info">
                                                    <i class="bi bi-info-circle"></i>
                                                    <span>Объявлений в этой категории пока нет</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Категории объявлений пока не добавлены</p>
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

        /* Announcements Section */
        .announcements {
            padding: 40px 0;
            background: #fff;
        }

        .accordion {
            --bs-accordion-border-color: #e5e7eb;
            --bs-accordion-border-radius: 8px;
            --bs-accordion-btn-padding-x: 20px;
            --bs-accordion-btn-padding-y: 20px;
        }

        .accordion-item {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .accordion-button {
            background: #fff;
            color: #212529;
            font-weight: 600;
            font-size: 18px;
            font-family: "Montserrat", sans-serif;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: #f8f9fa;
            color: #212529;
        }

        .accordion-button i {
            color: #0d9488;
            font-size: 20px;
        }

        .accordion-body {
            padding: 25px !important;
            background: #fff !important;
            color: #495057 !important;
        }

        .accordion-body * {
            visibility: visible !important;
            opacity: 1 !important;
        }

        .accordion-collapse {
            background: #fff !important;
        }

        .announcements-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .announcement-item {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .announcement-item:hover {
            background: #e9ecef;
        }

        .announcement-text {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 15px;
        }

        .announcement-text p {
            margin-bottom: 10px;
        }

        .announcement-text p:last-child {
            margin-bottom: 0;
        }

        .announcement-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .announcement-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #0d9488;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .announcement-link:hover {
            background: #0b7d73;
            color: #fff;
        }


        .alert {
            padding: 20px;
            border-radius: 8px;
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 20px;
        }

        .alert.text-center {
            padding: 30px;
            justify-content: center;
        }

        .alert.text-center i {
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

        [data-theme="dark"] .announcements {
            background: #1a1a1a;
        }

        [data-theme="dark"] .accordion-item {
            background: #2a2a2a;
            border-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .accordion-button {
            background: #2a2a2a;
            color: #e0e0e0;
        }

        [data-theme="dark"] .accordion-button:not(.collapsed) {
            background: #1a1a1a;
            color: #e0e0e0;
        }

        [data-theme="dark"] .announcement-item {
            background: #1a1a1a;
        }

        [data-theme="dark"] .announcement-item:hover {
            background: #2a2a2a;
        }

        [data-theme="dark"] .announcement-text {
            color: #adb5bd;
        }

        [data-theme="dark"] .accordion-body {
            background: #2a2a2a !important;
            color: #adb5bd !important;
        }

        [data-theme="dark"] .accordion-collapse {
            background: #2a2a2a !important;
        }

        @media (max-width: 768px) {
            .accordion-button {
                font-size: 16px;
                padding: 15px;
            }

            .accordion-body {
                padding: 20px;
            }

            .announcement-item {
                padding: 15px;
            }

            .announcement-actions {
                flex-direction: column;
            }

            .announcement-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

