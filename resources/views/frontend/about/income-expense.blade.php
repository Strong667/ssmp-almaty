@extends('frontend.layouts.app')

@section('title', 'Отчёты о доходах и расходах')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.income_expense') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Income Expense Reports Section -->
    <section class="income-expense section">
        <div class="container">
            @if($reports->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Отчёты о доходах и расходах пока не добавлены</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($reports as $report)
                        <div class="col-12">
                            <div class="report-card">
                                <div class="report-header">
                                    <div class="report-icon">
                                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    </div>
                                    <div class="report-content">
                                        <h3 class="report-title">{{ $report->localized_title }}</h3>
                                        @if($report->description)
                                            <div class="report-description">
                                                {!! $report->description !!}
                                            </div>
                                        @endif
                                        @if($report->localized_file_url)
                                            <div class="report-actions">
                                                <a href="{{ $report->localized_file_url }}" download class="report-link">
                                                    <i class="bi bi-download"></i>
                                                    <span>Скачать файл</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
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

        /* Income Expense Reports Section */
        .income-expense {
            padding: 40px 0;
            background: #fff;
        }

        .report-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .report-header {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            align-items: flex-start;
        }

        .report-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #FFC107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .report-content {
            flex-grow: 1;
        }

        .report-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 15px 0;
            color: #212529;
            line-height: 1.3;
            font-family: "Montserrat", sans-serif;
        }

        .report-description {
            font-size: 16px;
            line-height: 1.8;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .report-description p {
            margin-bottom: 10px;
        }

        .report-description p:last-child {
            margin-bottom: 0;
        }

        .report-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .report-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFC107;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .report-link:hover {
            background: #d4a000;
            color: #fff;
        }

        .report-link-secondary {
            background: #6c757d;
        }

        .report-link-secondary:hover {
            background: #d4a000;
        }

        .report-link i {
            font-size: 16px;
        }

        .report-date {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .report-date i {
            font-size: 16px;
        }

        .report-preview {
            width: 100%;
            height: 800px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background: #f8f9fa;
            margin-top: 20px;
        }

        .report-iframe {
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
            color: #FFC107;
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: #e0e0e0;
        }

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .income-expense {
            background: #1a1a1a;
        }

        [data-theme="dark"] .report-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .report-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .report-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .report-description {
            color: #b0b0b0;
        }

        [data-theme="dark"] .report-date {
            color: #b0b0b0;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .report-card {
                padding: 20px;
            }

            .report-header {
                flex-direction: column;
                gap: 15px;
            }

            .report-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                font-size: 20px;
            }

            .report-title {
                font-size: 20px;
                margin-bottom: 12px;
            }

            .report-description {
                font-size: 15px;
                margin-bottom: 15px;
            }

            .report-actions {
                flex-direction: column;
            }

            .report-link {
                width: 100%;
                justify-content: center;
                padding: 10px 16px;
                font-size: 14px;
            }

            .report-preview {
                height: 500px;
            }
        }
    </style>
    @endpush
@endsection

