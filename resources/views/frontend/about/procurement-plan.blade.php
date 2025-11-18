@extends('frontend.layouts.app')

@section('title', 'План государственных закупок')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.procurement_plan') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Procurement Plan Section -->
    <section class="procurement-plan section">
        <div class="container">
            @if($plans->isNotEmpty())
                <div class="row gy-4">
                    @foreach($plans as $plan)
                        <div class="col-12">
                            <div class="plan-card">
                                <div class="plan-header">
                                    <div class="plan-icon">
                                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    </div>
                                    <div class="plan-content">
                                        <h3 class="plan-title">{{ $plan->localized_title }}</h3>
                                        @if($plan->year)
                                            <div class="plan-year">
                                                <i class="bi bi-calendar"></i>
                                                <span>{{ __('frontend.procurement_plan.year', ['year' => $plan->year]) }}</span>
                                            </div>
                                        @endif
                                        @if($plan->localized_file_url)
                                            <div class="plan-actions">
                                                <a href="{{ $plan->localized_file_url }}" target="_blank" class="plan-link">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                    <span>{{ __('frontend.procurement_plan.open_in_new_tab') }}</span>
                                                </a>
                                                <a href="{{ $plan->localized_file_url }}" download class="plan-link plan-link-secondary">
                                                    <i class="bi bi-download"></i>
                                                    <span>{{ __('frontend.procurement_plan.download_file') }}</span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="plan-no-file">
                                                <i class="bi bi-exclamation-circle"></i>
                                                <span>{{ __('frontend.procurement_plan.file_not_uploaded') }}</span>
                                            </div>
                                        @endif
                                    </div>
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
                            <p class="mb-0">Планы закупок пока не добавлены</p>
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

        /* Procurement Plan Section */
        .procurement-plan {
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

        .plan-header {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .plan-icon {
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

        .plan-content {
            flex-grow: 1;
        }

        .plan-title {
            font-size: 22px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 15px 0;
            font-family: "Montserrat", sans-serif;
        }

        .plan-year {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .plan-year i {
            color: #0d9488;
            font-size: 18px;
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
            border-radius: 8px;
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

        .plan-no-file {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #dc3545;
            font-size: 14px;
        }

        .plan-no-file i {
            font-size: 18px;
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

        [data-theme="dark"] .procurement-plan {
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

        [data-theme="dark"] .plan-year {
            color: #adb5bd;
        }

        [data-theme="dark"] .plan-no-file {
            color: #ff6b6b;
        }

        @media (max-width: 768px) {
            .plan-card {
                padding: 20px;
            }

            .plan-header {
                flex-direction: column;
                gap: 15px;
            }

            .plan-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 18px;
            }

            .plan-title {
                font-size: 20px;
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

