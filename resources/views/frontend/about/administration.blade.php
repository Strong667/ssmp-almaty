@extends('frontend.layouts.app')

@section('title', 'Администрация')

@section('content')
    <!-- Administration Section -->
    <section id="administration" class="administration section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>Администрация</h2>
                <p>Руководящий состав медицинского центра</p>
            </header>

            @if($admins->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <p>Информация об администрации пока не добавлена</p>
                </div>
            @else
                <div class="row gy-4">
                    @foreach($admins as $admin)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="admin-card">
                                <div class="admin-image">
                                    @if($admin->image_url)
                                        <img src="{{ $admin->image_url }}" alt="{{ $admin->full_name }}" class="img-fluid">
                                    @else
                                        <div class="admin-placeholder">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="admin-content">
                                    <h3 class="admin-name">{{ $admin->full_name }}</h3>
                                    <p class="admin-position">{{ $admin->position }}</p>
                                    @if($admin->email)
                                        <div class="admin-contact">
                                            <a href="mailto:{{ $admin->email }}" class="admin-email">
                                                <i class="bi bi-envelope"></i>
                                                {{ $admin->email }}
                                            </a>
                                        </div>
                                    @endif
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
        /* Administration Section */
        .administration {
            padding: 120px 0 80px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 64px;
            color: #1977cc;
            margin-bottom: 20px;
            display: block;
        }

        .empty-state p {
            font-size: 18px;
            margin: 0;
        }

        [data-theme="dark"] .empty-state {
            color: #b0b0b0;
        }

        .admin-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .admin-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.12);
        }

        .admin-image {
            width: 100%;
            height: 300px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        .admin-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .admin-card:hover .admin-image img {
            transform: scale(1.1);
        }

        .admin-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.8);
        }

        .admin-placeholder i {
            font-size: 120px;
        }

        .admin-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #2c4964;
            line-height: 1.3;
        }

        .admin-position {
            font-size: 16px;
            color: #1977cc;
            font-weight: 500;
            margin: 0 0 15px 0;
        }

        .admin-contact {
            margin-top: auto;
        }

        .admin-email {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .admin-email:hover {
            color: #1977cc;
        }

        .admin-email i {
            font-size: 16px;
        }

        /* Dark Theme */
        [data-theme="dark"] .administration {
            background: #1a1a1a;
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
            color: #1977cc;
        }

        [data-theme="dark"] .admin-email {
            color: #b0b0b0;
        }

        [data-theme="dark"] .admin-email:hover {
            color: #1977cc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .administration {
                padding: 100px 0 60px;
            }

            .admin-image {
                height: 250px;
            }

            .admin-content {
                padding: 25px;
            }

            .admin-name {
                font-size: 20px;
            }
        }
    </style>
    @endpush
@endsection

