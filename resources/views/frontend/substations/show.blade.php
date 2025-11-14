@extends('frontend.layouts.app')

@section('title', $substation->name . ' - Сотрудники')

@section('content')
    <section class="substation-employees section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="substation-header mb-4">
                        <a href="{{ route('home') }}" class="back-link">
                            <i class="bi bi-arrow-left"></i> Назад на главную
                        </a>
                        <h1 class="substation-name">{{ $substation->name }}</h1>
                        <p class="substation-info">
                            <i class="bi bi-geo-alt"></i> {{ $substation->address }} | 
                            <i class="bi bi-telephone"></i> {{ $substation->phone }}
                        </p>
                    </div>
                </div>
            </div>

            @if($employees->isNotEmpty())
                <div class="row gy-4">
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
                                    <h3 class="employee-name">{{ $employee['full_name'] }}</h3>
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
                <div class="row">
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
        .substation-employees {
            padding: 80px 0;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1977cc;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #0d5aa7;
            transform: translateX(-5px);
        }

        .substation-header {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 40px;
        }

        .substation-name {
            font-size: 36px;
            font-weight: 700;
            color: #2c4964;
            margin: 20px 0 15px;
        }

        .substation-info {
            font-size: 18px;
            color: #6c757d;
            margin: 0;
        }

        .substation-info i {
            margin-right: 5px;
            color: #1977cc;
        }

        .employee-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .employee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-size: 120px;
        }

        .employee-info {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .employee-name {
            font-size: 22px;
            font-weight: 700;
            color: #2c4964;
            margin: 0 0 10px 0;
        }

        .employee-position {
            font-size: 16px;
            color: #1977cc;
            font-weight: 600;
            margin: 0 0 15px 0;
        }

        .employee-description {
            font-size: 14px;
            color: #6c757d;
            line-height: 1.6;
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

        [data-theme="dark"] .substation-name {
            color: #e2e8f0;
        }

        [data-theme="dark"] .substation-info {
            color: #94a3b8;
        }

        [data-theme="dark"] .substation-header {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .employee-card {
            background: #2a2a2a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .employee-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .employee-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .employee-description {
            color: #b0b0b0;
        }

        @media (max-width: 991px) {
            .substation-name {
                font-size: 28px;
            }

            .substation-info {
                font-size: 16px;
            }

            .employee-photo,
            .employee-photo-placeholder {
                height: 250px;
            }
        }
    </style>
    @endpush
@endsection

