@extends('frontend.layouts.app')

@section('title', 'Администрация')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.menu.administration') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Administration Section -->
    <section class="administration section">
        <div class="container">
            @if($admins->isNotEmpty())
                <div class="row gy-4">
                    @foreach($admins as $admin)
                        <div class="col-lg-4 col-md-6">
                            <div class="admin-card">
                                @if($admin->image_url)
                                    <div class="admin-photo">
                                        <img src="{{ $admin->image_url }}" alt="{{ $admin->full_name }}" class="img-fluid">
                                    </div>
                                @else
                                    <div class="admin-photo-placeholder">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                @endif
                                <div class="admin-info">
                                    <h4 class="admin-name">{{ $admin->full_name }}</h4>
                                    <p class="admin-position">{{ $admin->position }}</p>
                                    @if($admin->email)
                                        <div class="admin-email">
                                            <i class="bi bi-envelope"></i>
                                            <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>
                                        </div>
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
                            <p class="mb-0">Администрация пока не добавлена</p>
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

        /* Administration Section */
        .administration {
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

        .admin-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .admin-photo {
            width: 100%;
            height: 300px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .admin-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .admin-photo-placeholder {
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

        .admin-info {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 10px 0;
            font-family: "Montserrat", sans-serif;
        }

        .admin-position {
            font-size: 15px;
            color: #0d9488;
            font-weight: 500;
            margin: 0 0 15px 0;
        }

        .admin-email {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: auto;
            font-size: 14px;
        }

        .admin-email i {
            color: #0d9488;
            font-size: 16px;
        }

        .admin-email a {
            color: #495057;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .admin-email a:hover {
            color: #0d9488;
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

        [data-theme="dark"] .administration {
            background: #1a1a1a;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .admin-card {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .admin-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .admin-photo-placeholder {
            background: #2a2a2a;
            border-bottom-color: rgba(255, 255, 255, 0.1);
            color: #495057;
        }

        [data-theme="dark"] .admin-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .admin-email a {
            color: #adb5bd;
        }

        [data-theme="dark"] .admin-email a:hover {
            color: #0d9488;
        }

        @media (max-width: 991px) {
            .section-title {
                font-size: 24px;
            }

            .admin-photo,
            .admin-photo-placeholder {
                height: 250px;
            }
        }
    </style>
    @endpush
@endsection
