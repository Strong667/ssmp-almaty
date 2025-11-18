@extends('frontend.layouts.app')

@section('title', 'Платные услуги')

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
                    <li class="breadcrumb-item active" aria-current="page">Платные услуги</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Paid Services Section -->
    <section class="paid-services section">
        <div class="container">
            @if($services->isNotEmpty())
                @foreach($services as $service)
                    @if($service->items->isNotEmpty())
                        <div class="service-card mb-5">
                            <div class="service-header">
                                <h3 class="service-title">{{ $service->title ?? 'Коммерческое предложение' }}</h3>
                            </div>
                            <div class="service-content">
                                @if($service->description)
                                    <div class="service-description mb-4">
                                        <p>{{ $service->description }}</p>
                                    </div>
                                @endif

                                @if($service->items->isNotEmpty())
                                    <div class="table-responsive mb-4">
                                        <table class="service-table">
                                            <thead>
                                                <tr>
                                                    <th>Наименование</th>
                                                    <th>Ед. изм.</th>
                                                    <th>Стоимость (тенге), без учета НДС</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($service->items as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->unit }}</td>
                                                        <td class="price-cell">{{ number_format($item->price, 0, ',', ' ') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if($service->file_url)
                                    <div class="service-file">
                                        <a href="{{ $service->file_url }}" target="_blank" class="file-link" download>
                                            <i class="bi bi-file-earmark"></i>
                                            <span>Скачать файл</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
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

        /* Paid Services Section */
        .paid-services {
            padding: 40px 0;
            background: #fff;
        }

        .service-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .service-header {
            padding: 20px 30px;
            background: #f8f9fa;
            border-bottom: 1px solid #e5e7eb;
        }

        .service-title {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #2c4964;
            font-family: 'Montserrat', sans-serif;
        }

        .service-content {
            padding: 30px;
        }

        .service-description {
            color: #495057;
            font-size: 15px;
            line-height: 1.6;
            font-family: 'Montserrat', sans-serif;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .service-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Montserrat', sans-serif;
        }

        .service-table thead {
            background: #f8f9fa;
        }

        .service-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c4964;
            border-bottom: 2px solid #e5e7eb;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .service-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #495057;
            font-size: 14px;
        }

        .service-table tbody tr:hover {
            background: #f8f9fa;
        }

        .service-table tbody tr:last-child td {
            border-bottom: none;
        }

        .price-cell {
            font-weight: 600;
            color: #2c4964;
            text-align: right;
        }

        .service-file {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0d9488;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-weight: 500;
            background: #e6f7f5;
        }

        .file-link:hover {
            background: #0d9488;
            color: #fff;
        }

        .file-link i {
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

        [data-theme="dark"] .paid-services {
            background: #1a1a1a;
        }

        [data-theme="dark"] .service-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .service-header {
            background: #1a1a1a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .service-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .service-description {
            color: #adb5bd;
        }

        [data-theme="dark"] .service-table thead {
            background: #1a1a1a;
        }

        [data-theme="dark"] .service-table th {
            color: #e0e0e0;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .service-table td {
            color: #adb5bd;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .service-table tbody tr:hover {
            background: #1a1a1a;
        }

        [data-theme="dark"] .price-cell {
            color: #e0e0e0;
        }

        [data-theme="dark"] .service-file {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .file-link {
            background: rgba(13, 148, 136, 0.2);
            color: #0d9488;
        }

        [data-theme="dark"] .file-link:hover {
            background: #0d9488;
            color: #fff;
        }

        @media (max-width: 768px) {
            .service-header {
                padding: 15px 20px;
            }

            .service-content {
                padding: 20px;
            }

            .service-table {
                font-size: 12px;
            }

            .service-table th,
            .service-table td {
                padding: 10px 8px;
            }
        }
    </style>
    @endpush
@endsection
