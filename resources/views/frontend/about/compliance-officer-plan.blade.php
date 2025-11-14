@extends('frontend.layouts.app')

@section('title', 'План работы комплаенс офицера 2024г')

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
                    <li class="breadcrumb-item active" aria-current="page">План работы комплаенс офицера 2024г</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Compliance Officer Plan Section -->
    <section class="compliance-officer-plan section">
        <div class="container">
            @if($plans->isNotEmpty())
                <div class="row gy-4">
                    @foreach($plans as $plan)
                        <div class="col-12">
                            <div class="plan-card">
                                <h3 class="plan-title">{{ $plan->title }}</h3>
                                @if($plan->file_url)
                                    <div class="plan-pdf-wrapper">
                                        <iframe
                                            src="{{ $plan->file_url }}#toolbar=1&navpanes=1&scrollbar=1"
                                            width="100%"
                                            height="800"
                                            frameborder="0"
                                            allowfullscreen
                                        ></iframe>
                                    </div>
                                    <div class="plan-actions">
                                        <a href="{{ $plan->file_url }}" target="_blank" class="plan-link">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                            <span>Открыть в новой вкладке</span>
                                        </a>
                                        <a href="{{ $plan->file_url }}" download class="plan-link plan-link-secondary">
                                            <i class="bi bi-download"></i>
                                            <span>Скачать PDF</span>
                                        </a>
                                    </div>
                                @endif
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

        /* Compliance Officer Plan Section */
        .compliance-officer-plan {
            padding: 40px 0;
            background: #fff;
        }

        .plan-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .plan-title {
            font-size: 22px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .plan-pdf-wrapper {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .plan-pdf-wrapper iframe {
            width: 100%;
            height: 800px;
            border: none;
            display: block;
        }

        .plan-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .plan-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #0d9488;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .plan-link:hover {
            background: #0b7d73;
            color: #fff;
        }

        .plan-link-secondary {
            background: #6c757d;
        }

        .plan-link-secondary:hover {
            background: #5a6268;
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

        [data-theme="dark"] .compliance-officer-plan {
            background: #1a1a1a;
        }

        [data-theme="dark"] .plan-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .plan-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .plan-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .plan-pdf-wrapper {
            border-color: rgba(255, 255, 255, 0.1);
            background: #1a1a1a;
        }

        @media (max-width: 768px) {
            .plan-card {
                padding: 20px;
            }

            .plan-title {
                font-size: 20px;
            }

            .plan-pdf-wrapper iframe {
                height: 600px;
            }

            .plan-actions {
                flex-direction: column;
            }

            .plan-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

