@extends('frontend.layouts.app')

@section('title', $substation->name . ' - Сотрудники')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ $substation->name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Substation Section -->
    <section class="substation section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="substation-info">
                        <h2 class="substation-name">{{ $substation->name }}</h2>
                        
                        <div class="substation-detail">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $substation->address }}</span>
                        </div>

                        @if($substation->phone)
                            <div class="substation-detail">
                                <i class="bi bi-telephone"></i>
                                <span>{{ $substation->phone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($employees->isNotEmpty())
                <div class="row gy-4 mt-4">
                    @foreach($employees as $employee)
                        <div class="col-lg-4 col-md-6">
                            <div class="employee-card">
                                @if($employee['photo_url'])
                                    <div class="employee-photo">
                                        <img src="{{ $employee['photo_url'] }}" alt="{{ $employee['full_name'] }}" class="img-fluid">
                                    </div>
                                @else
                                    <div class="employee-photo-placeholder">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                @endif
                                <div class="employee-info">
                                    <h4 class="employee-name">{{ $employee['full_name'] }}</h4>
                                    <p class="employee-position">{{ $employee['position'] }}</p>
                                    @if($employee['description'])
                                        <p class="employee-description">{{ $employee['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">Сотрудники пока не добавлены</p>
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

        /* Substation Section */
        .substation {
            padding: 40px 0;
            background: #fff;
        }

        .substation-info {
            padding: 0;
            margin-bottom: 30px;
        }

        .substation-name {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .substation-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .substation-detail:last-child {
            margin-bottom: 0;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .substation-detail i {
            color: #0d9488;
            font-size: 18px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .employee-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .employee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .employee-photo {
            width: 100%;
            height: 300px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .employee-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .employee-photo-placeholder {
            width: 100%;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #adb5bd;
            font-size: 120px;
            border-bottom: 1px solid #e5e7eb;
        }

        .employee-info {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .employee-name {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 10px 0;
            font-family: "Montserrat", sans-serif;
        }

        .employee-position {
            font-size: 15px;
            color: #0d9488;
            font-weight: 500;
            margin: 0 0 15px 0;
        }

        .employee-description {
            font-size: 14px;
            color: #495057;
            line-height: 1.7;
            margin: 0;
            flex-grow: 1;
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

        [data-theme="dark"] .substation {
            background: #1a1a1a;
        }

        [data-theme="dark"] .substation-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .substation-detail {
            color: #adb5bd;
        }

        [data-theme="dark"] .substation-detail:last-child {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .employee-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .employee-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .employee-photo-placeholder {
            background: #2a2a2a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
            color: #495057;
        }

        [data-theme="dark"] .employee-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .employee-description {
            color: #adb5bd;
        }

        @media (max-width: 991px) {
            .substation-name {
                font-size: 24px;
            }

            .employee-photo,
            .employee-photo-placeholder {
                height: 250px;
            }
        }
    </style>
    @endpush
@endsection

