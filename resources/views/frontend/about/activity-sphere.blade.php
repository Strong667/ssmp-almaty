@extends('frontend.layouts.app')

@section('title', 'Сфера деятельности')

@section('content')
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">{{ __('frontend.breadcrumbs.home') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> >> {{ __('frontend.menu.activity_sphere') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Activity Sphere Section -->
    <section class="activity-sphere section">
        <div class="container">
            @if($activitySphere)
                <div class="row">
                    <div class="col-12">
                        @if($activitySphere->general_info)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                    <h3 class="info-title">Общая информация</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->localized_general_info !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->localized_mission)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-bullseye"></i>
                                    </div>
                                    <h3 class="info-title">Миссия</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->localized_mission !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->localized_goal)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <h3 class="info-title">Цель</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->localized_goal !!}
                                </div>
                            </div>
                        @endif

                        @if($activitySphere->localized_history)
                            <div class="info-card">
                                <div class="info-header">
                                    <div class="info-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <h3 class="info-title">История</h3>
                                </div>
                                <div class="info-content">
                                    {!! $activitySphere->localized_history !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Информация о сфере деятельности пока не добавлена</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- SSMP Structure Table -->
            @if(isset($ssmpStructures) && $ssmpStructures->isNotEmpty())
                @php
                    $totalSubstations = $ssmpStructures->count();
                    $totalBrigades = $ssmpStructures->sum('brigades_count');
                    $totalDoctors = $ssmpStructures->sum('doctors_count');
                    $totalParamedics = $ssmpStructures->sum('paramedics_count');
                    $totalJuniorStaff = $ssmpStructures->sum('junior_staff_count');
                    $totalEmployees = $totalDoctors + $totalParamedics + $totalJuniorStaff;
                @endphp
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="structure-card">
                            <h3 class="structure-table-title">Структура ССМП</h3>
                            <p class="structure-table-subtitle">{{ $totalSubstations }} подстанций, {{ $totalBrigades }} бригад, {{ $totalEmployees }} сотрудников</p>
                            <div class="table-responsive">
                                <table class="table structure-table">
                                    <thead>
                                        <tr>
                                            <th>№ п/с</th>
                                            <th>Адрес</th>
                                            <th>Кол-во бригад</th>
                                            <th>Кол-во врачей</th>
                                            <th>Кол-во фельдшеров</th>
                                            <th>Младший персонал</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ssmpStructures as $structure)
                                            <tr>
                                                <td>{{ $structure->substation_number }}</td>
                                                <td>{{ $structure->localized_address }}</td>
                                                <td>{{ $structure->brigades_count }}</td>
                                                <td>{{ $structure->doctors_count }}</td>
                                                <td>{{ $structure->paramedics_count }}</td>
                                                <td>{{ $structure->junior_staff_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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

        /* Activity Sphere Section */
        .activity-sphere {
            padding: 40px 0;
            background: #fff;
        }

        .info-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .info-card:last-child {
            margin-bottom: 0;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: #FFC107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
        }

        .info-title {
            font-size: 24px;
            font-weight: 600;
            color: #212529;
            margin: 0;
            font-family: "Montserrat", sans-serif;
        }

        .info-content {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
        }

        .info-content p {
            margin-bottom: 15px;
        }

        .info-content p:last-child {
            margin-bottom: 0;
        }

        /* Structure Table */
        .structure-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 30px;
        }

        .structure-table-title {
            font-size: 24px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 10px 0;
            font-family: "Montserrat", sans-serif;
        }

        .structure-table-subtitle {
            font-size: 16px;
            color: #6c757d;
            margin: 0 0 25px 0;
        }

        .structure-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .structure-table thead {
            background: #FFC107;
            color: #fff;
        }

        .structure-table thead th {
            padding: 15px 12px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            border: none;
            font-family: "Montserrat", sans-serif;
        }

        .structure-table thead th:first-child {
            border-top-left-radius: 8px;
        }

        .structure-table thead th:last-child {
            border-top-right-radius: 8px;
        }

        .structure-table tbody tr {
            background: #fff;
            transition: background 0.2s ease;
        }

        .structure-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .structure-table tbody tr:hover {
            background: #e9ecef;
        }

        .structure-table tbody td {
            padding: 15px 12px;
            font-size: 14px;
            color: #495057;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .structure-table tbody td:first-child {
            font-weight: 600;
            color: #2c4964;
        }

        .structure-table tbody td:nth-child(2) {
            text-align: left;
        }

        .structure-table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
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


        [data-theme="dark"] .activity-sphere {
            background: #1a1a1a;
        }

        [data-theme="dark"] .info-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .info-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .info-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .info-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .info-content {
            color: #adb5bd;
        }

        [data-theme="dark"] .structure-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .structure-table-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .structure-table-subtitle {
            color: #adb5bd;
        }

        [data-theme="dark"] .structure-table tbody tr {
            background: #2a2a2a;
        }

        [data-theme="dark"] .structure-table tbody tr:nth-child(even) {
            background: #333333;
        }

        [data-theme="dark"] .structure-table tbody tr:hover {
            background: #3a3a3a;
        }

        [data-theme="dark"] .structure-table tbody td {
            color: #adb5bd;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .structure-table tbody td:first-child {
            color: #e0e0e0;
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 20px;
            }

            .info-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .info-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
                font-size: 20px;
            }

            .info-title {
                font-size: 20px;
            }

            .structure-card {
                padding: 20px;
            }

            .structure-table-title {
                font-size: 20px;
            }

            .structure-table-subtitle {
                font-size: 14px;
            }

            .structure-table thead th,
            .structure-table tbody td {
                padding: 10px 8px;
                font-size: 12px;
            }
        }
    </style>
    @endpush
@endsection

