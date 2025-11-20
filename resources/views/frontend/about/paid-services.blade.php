@extends('frontend.layouts.app')

@section('title', 'Платные услуги')

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('frontend.breadcrumbs.home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> >> {{ __('frontend.header.paid_services') }}</li>
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
                                <h3 class="service-title">{{ $service->localized_title ?? 'Коммерческое предложение' }}</h3>
                            </div>
                            <div class="service-content">
                                @if($service->localized_description)
                                    <div class="service-description mb-4">
                                        <p>{{ $service->localized_description }}</p>
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
                                                        <td>{{ $item->localized_name }}</td>
                                                        <td>{{ $item->unit }}</td>
                                                        <td class="price-cell">{{ number_format($item->price, 0, ',', ' ') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($service->localized_file_url)
                                        <div class="service-actions">
                                            <button type="button" class="view-btn" onclick="openPdfSidebar('{{ $service->localized_file_url }}', '{{ addslashes($service->localized_title ?? 'Коммерческое предложение') }}')">
                                                <i class="bi bi-eye"></i>
                                                <span>Просмотр</span>
                                            </button>
                                        </div>
                                    @endif
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

    <!-- PDF Sidebar -->
    <div id="pdf-sidebar" class="pdf-sidebar">
        <div class="pdf-sidebar-overlay" onclick="closePdfSidebar()"></div>
        <div class="pdf-sidebar-content">
            <div class="pdf-sidebar-header">
                <h3 id="pdf-sidebar-title" class="pdf-sidebar-title"></h3>
                <button type="button" class="pdf-sidebar-close" onclick="closePdfSidebar()" aria-label="Закрыть">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="pdf-sidebar-body">
                <iframe id="pdf-sidebar-iframe" src="" class="pdf-sidebar-iframe" title="PDF Viewer"></iframe>
            </div>
        </div>
    </div>

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
        }

        .service-actions {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #FFC107;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .view-btn:hover {
            background: #d4a000;
            color: #fff;
        }

        .view-btn i {
            font-size: 14px;
        }

        /* PDF Sidebar - Matching Mobile Menu Design */
        .pdf-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            z-index: 99999;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: visibility 0s linear 0.3s, opacity 0.3s ease;
        }

        .pdf-sidebar.active {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
            transition: visibility 0s linear 0s, opacity 0.3s ease;
        }

        .pdf-sidebar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pdf-sidebar.active .pdf-sidebar-overlay {
            opacity: 1;
        }

        .pdf-sidebar-content {
            position: absolute;
            top: 0;
            right: 0;
            width: 900px;
            max-width: 85vw;
            height: 100vh;
            background: rgba(44, 73, 100, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: -4px 0 24px rgba(0, 0, 0, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .pdf-sidebar.active .pdf-sidebar-content {
            transform: translateX(0);
        }

        .pdf-sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: rgba(0, 0, 0, 0.35);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .pdf-sidebar-title {
            margin: 0;
            color: #FFC107;
            font-size: 20px;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
            flex: 1;
            padding-right: 20px;
        }

        .pdf-sidebar-close {
            background: transparent;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #FFC107;
            padding: 0;
            flex-shrink: 0;
        }

        .pdf-sidebar-close:hover {
            color: #fff;
            opacity: 0.8;
        }

        .pdf-sidebar-close i {
            font-size: 24px;
            font-weight: 400;
        }

        .pdf-sidebar-body {
            flex: 1;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.05);
        }

        .pdf-sidebar-iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: #fff;
        }

        [data-theme="dark"] .pdf-sidebar-header {
            background: rgba(0, 0, 0, 0.4);
            border-bottom-color: rgba(255, 255, 255, 0.15);
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

        [data-theme="dark"] .service-actions {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .view-btn {
            background: #FFC107;
            color: #fff;
        }

        [data-theme="dark"] .view-btn:hover {
            background: #d4a000;
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

        @media (max-width: 768px) {
            .pdf-sidebar-content {
                width: 100%;
                max-width: 100vw;
            }

            .pdf-sidebar-header {
                padding: 16px 20px;
            }

            .pdf-sidebar-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .pdf-sidebar-header {
                padding: 14px 16px;
            }

            .pdf-sidebar-title {
                font-size: 16px;
                padding-right: 12px;
            }

            .pdf-sidebar-close {
                width: 32px;
                height: 32px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function openPdfSidebar(pdfUrl, title) {
            const sidebar = document.getElementById('pdf-sidebar');
            const iframe = document.getElementById('pdf-sidebar-iframe');
            const titleElement = document.getElementById('pdf-sidebar-title');
            
            iframe.src = pdfUrl + '#toolbar=0&navpanes=0&scrollbar=0';
            titleElement.textContent = title;
            sidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePdfSidebar() {
            const sidebar = document.getElementById('pdf-sidebar');
            const iframe = document.getElementById('pdf-sidebar-iframe');
            
            sidebar.classList.remove('active');
            document.body.style.overflow = '';
            
            // Очищаем iframe после закрытия для экономии ресурсов
            setTimeout(() => {
                iframe.src = '';
            }, 300);
        }

        // Закрытие по ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePdfSidebar();
            }
        });
    </script>
    @endpush
@endsection
