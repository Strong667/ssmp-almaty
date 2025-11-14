@extends('frontend.layouts.app')

@section('title', 'Администрация')

@section('content')
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>Администрация</h2>
            </header>

            @if($admins->isNotEmpty())
                <div class="row gy-4">
                    @foreach($admins as $admin)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up">
                            <div class="admin-card">
                                @if($admin->image_url)
                                    <div class="admin-img">
                                        <img src="{{ $admin->image_url }}" alt="{{ $admin->full_name }}" class="img-fluid">
                                    </div>
                                @endif
                                <div class="admin-content">
                                    <h3 class="admin-name">{{ $admin->full_name }}</h3>
                                    <p class="admin-position">{{ $admin->position }}</p>
                                    @if($admin->email)
                                        <p class="admin-email">
                                            <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <p>Администрация пока не добавлена</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        .admin-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .admin-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .admin-img {
            overflow: hidden;
            height: 300px;
        }

        .admin-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .admin-card:hover .admin-img img {
            transform: scale(1.1);
        }

        .admin-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #2c4964;
        }

        .admin-position {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .admin-email {
            margin: 0;
            margin-top: auto;
        }

        .admin-email a {
            color: #1977cc;
            text-decoration: none;
            font-size: 14px;
        }

        .admin-email a:hover {
            color: #0d5aa7;
        }

        [data-theme="dark"] .admin-card {
            background: #2a2a2a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .admin-card:hover {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .admin-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .admin-position {
            color: #b0b0b0;
        }
    </style>
    @endpush
@endsection
