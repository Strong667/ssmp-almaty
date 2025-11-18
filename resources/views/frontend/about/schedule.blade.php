@extends('frontend.layouts.app')

@section('title', 'График приёма граждан')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.schedule') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="schedule section">
        <div class="container">
            @if($schedules->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="schedule-table">
                                <thead>
                                    <tr>
                                        <th>ФИО</th>
                                        <th>Должность</th>
                                        <th>День</th>
                                        <th>Время</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td>
                                                <div class="schedule-name">
                                                    <i class="bi bi-person"></i>
                                                    <span>{{ $schedule->full_name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $schedule->position }}</td>
                                            <td>
                                                <div class="schedule-day">
                                                    <i class="bi bi-calendar-event"></i>
                                                    <span>{{ $schedule->day }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="schedule-time">
                                                    <i class="bi bi-clock"></i>
                                                    <span>{{ $schedule->time }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">График приёма граждан пока не добавлен</p>
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

        /* Schedule Section */
        .schedule {
            padding: 40px 0;
            background: #fff;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .schedule-table thead {
            background: #f8f9fa;
        }

        .schedule-table thead th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 15px;
            color: #212529;
            font-family: "Montserrat", sans-serif;
            border-bottom: 2px solid #e5e7eb;
        }

        .schedule-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .schedule-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .schedule-table tbody tr:not(:last-child) {
            border-bottom: 1px solid #e5e7eb;
        }

        .schedule-table tbody td {
            padding: 20px;
            font-size: 15px;
            color: #495057;
            vertical-align: middle;
        }

        .schedule-name,
        .schedule-day,
        .schedule-time {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .schedule-name i,
        .schedule-day i,
        .schedule-time i {
            color: #0d9488;
            font-size: 18px;
        }

        .schedule-name span,
        .schedule-day span,
        .schedule-time span {
            color: #495057;
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

        [data-theme="dark"] .schedule {
            background: #1a1a1a;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .schedule-table {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .schedule-table thead {
            background: #1a1a1a;
        }

        [data-theme="dark"] .schedule-table thead th {
            color: #e0e0e0;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .schedule-table tbody tr:hover {
            background-color: #1a1a1a;
        }

        [data-theme="dark"] .schedule-table tbody tr:not(:last-child) {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .schedule-table tbody td {
            color: #adb5bd;
        }

        [data-theme="dark"] .schedule-name span,
        [data-theme="dark"] .schedule-day span,
        [data-theme="dark"] .schedule-time span {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .section-title {
                font-size: 24px;
            }

            .schedule-table {
                font-size: 14px;
            }

            .schedule-table thead th,
            .schedule-table tbody td {
                padding: 15px 10px;
            }
        }

        @media (max-width: 767px) {
            .schedule-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
    @endpush
@endsection
