@extends('frontend.layouts.app')

@section('title', 'Этический кодекс')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.ethical_code') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Ethical Code Section -->
    <section class="ethical-code section">
        <div class="container">

            @if($ethicalCodes->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Документы этического кодекса пока не добавлены</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($ethicalCodes as $ethicalCode)
                        <div class="col-12">
                            <div class="ethical-code-card">
                                <div class="ethical-code-header">
                                    <div class="ethical-code-icon">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div class="ethical-code-content">
                                        <h3 class="ethical-code-title">{{ $ethicalCode->localized_title }}</h3>
                                        @if($ethicalCode->localized_pdf_url)
                                            <div class="ethical-code-actions">
                                                <a href="{{ $ethicalCode->localized_pdf_url }}" target="_blank" class="ethical-code-link">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                    <span>Открыть в новой вкладке</span>
                                                </a>
                                                <a href="{{ $ethicalCode->localized_pdf_url }}" download class="ethical-code-link ethical-code-link-secondary">
                                                    <i class="bi bi-download"></i>
                                                    <span>Скачать PDF</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($ethicalCode->localized_pdf_url)
                                    <div class="ethical-code-preview">
                                        <iframe src="{{ $ethicalCode->localized_pdf_url }}#toolbar=1&navpanes=0&scrollbar=1" 
                                                class="ethical-code-iframe" 
                                                title="{{ $ethicalCode->localized_title }}">
                                            <p>Ваш браузер не поддерживает отображение PDF. 
                                                <a href="{{ $ethicalCode->localized_pdf_url }}" target="_blank">Откройте PDF в новой вкладке</a>.
                                            </p>
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
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

        /* Ethical Code Section */
        .ethical-code {
            padding: 40px 0;
            background: #fff;
        }

        .ethical-code-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .ethical-code-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .ethical-code-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .ethical-code-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #0d9488;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .ethical-code-content {
            flex-grow: 1;
        }

        .ethical-code-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 20px 0;
            color: #212529;
            line-height: 1.3;
            font-family: "Montserrat", sans-serif;
        }

        .ethical-code-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ethical-code-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #0d9488;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .ethical-code-link:hover {
            background: #0b7d73;
            color: #fff;
        }

        .ethical-code-link-secondary {
            background: #6c757d;
        }

        .ethical-code-link-secondary:hover {
            background: #5a6268;
        }

        .ethical-code-link i {
            font-size: 16px;
        }

        .ethical-code-preview {
            width: 100%;
            height: 800px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background: #f8f9fa;
            margin-top: 20px;
        }

        .ethical-code-iframe {
            width: 100%;
            height: 100%;
            border: none;
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

        /* Dark Theme */
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

        [data-theme="dark"] .ethical-code {
            background: #1a1a1a;
        }

        [data-theme="dark"] .ethical-code-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .ethical-code-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .ethical-code-title {
            color: #e0e0e0;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .ethical-code-card {
                padding: 20px;
            }

            .ethical-code-header {
                flex-direction: column;
                gap: 15px;
            }

            .ethical-code-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                font-size: 20px;
            }

            .ethical-code-title {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .ethical-code-actions {
                flex-direction: column;
            }

            .ethical-code-link {
                width: 100%;
                justify-content: center;
                padding: 10px 16px;
                font-size: 14px;
            }

            .ethical-code-preview {
                height: 500px;
            }
        }
    </style>
    @endpush
@endsection

