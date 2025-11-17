@extends('frontend.layouts.app')

@section('title', 'Протоколы')

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
                    <li class="breadcrumb-item active" aria-current="page">Протоколы</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Protocols Section -->
    <section class="protocols section">
        <div class="container">
            @if($protocolsByYear->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="protocolsAccordion">
                            @foreach($protocolsByYear as $year => $protocols)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $year }}">
                                        <button class="accordion-button{{ $loop->first ? '' : ' collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $year }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $year }}">
                                            <i class="bi bi-calendar-range"></i>
                                            <span>Протоколы за {{ $year }} год</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $year }}" class="accordion-collapse collapse{{ $loop->first ? ' show' : '' }}" aria-labelledby="heading{{ $year }}" data-bs-parent="#protocolsAccordion">
                                        <div class="accordion-body">
                                            <div class="protocols-list">
                                                @foreach($protocols as $protocol)
                                                    <div class="protocol-item">
                                                        <div class="protocol-icon">
                                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                                        </div>
                                                        <div class="protocol-content">
                                                            <h4 class="protocol-title">{{ $protocol->title }}</h4>
                                                            @if($protocol->file_url)
                                                                <div class="protocol-actions">
                                                                    <a href="{{ $protocol->file_url }}" download class="protocol-link">
                                                                        <i class="bi bi-download"></i>
                                                                        <span>Скачать файл</span>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
                            <p class="mb-0">Протоколы пока не добавлены</p>
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

        /* Protocols Section */
        .protocols {
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

        .protocols-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .protocol-item {
            display: flex;
            gap: 15px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .protocol-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .protocol-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            background: #0d9488;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .protocol-content {
            flex-grow: 1;
        }

        .protocol-title {
            font-size: 18px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
        }

        .protocol-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .protocol-link {
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

        .protocol-link:hover {
            background: #0b7d73;
            color: #fff;
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

        [data-theme="dark"] .protocols {
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

        [data-theme="dark"] .protocol-item {
            background: #1a1a1a;
        }

        [data-theme="dark"] .protocol-item:hover {
            background: #2a2a2a;
        }

        [data-theme="dark"] .protocol-title {
            color: #e0e0e0;
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

            .protocol-item {
                flex-direction: column;
                gap: 12px;
            }

            .protocol-icon {
                width: 40px;
                height: 40px;
                min-width: 40px;
                font-size: 18px;
            }

            .protocol-title {
                font-size: 16px;
            }

            .protocol-actions {
                flex-direction: column;
            }

            .protocol-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @endpush
@endsection

