@extends('frontend.layouts.app')

@section('title', 'Блог о директоре')

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
                    <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.breadcrumbs.director_blog') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Director Blog Section -->
    <section class="director-blog section">
        <div class="container">

            @if($director)
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="director-photo-wrapper">
                            @if($director->photo_url)
                                <img src="{{ $director->photo_url }}" alt="{{ $director->full_name }}" class="director-photo img-fluid">
                            @else
                                <div class="director-photo-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="director-info">
                            <h2 class="director-name">{{ $director->full_name }}</h2>
                            
                            @if($director->birth_date)
                                <div class="director-detail">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>{{ __('frontend.director_blog.birth_date') }}: {{ $director->birth_date->format('d.m.Y') }}</span>
                                </div>
                            @endif

                            <!-- Tabs Navigation -->
                            @php
                                $hasPersonalInfo = $director->localized_personal_info;
                                $hasEducation = $director->localized_education;
                                $hasCareer = $director->localized_career;
                                $hasAwards = $director->localized_awards;
                                $firstTab = $hasPersonalInfo ? 'personal-info' : ($hasEducation ? 'education' : ($hasCareer ? 'career' : ($hasAwards ? 'awards' : null)));
                            @endphp
                            
                            @if($firstTab)
                                <ul class="nav nav-tabs director-tabs" id="directorInfoTab" role="tablist">
                                    @if($hasPersonalInfo)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link{{ $firstTab === 'personal-info' ? ' active' : '' }}" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="{{ $firstTab === 'personal-info' ? 'true' : 'false' }}">
                                                {{ __('frontend.director_blog.personal_info') }}
                                            </button>
                                        </li>
                                    @endif
                                    @if($hasEducation)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link{{ $firstTab === 'education' ? ' active' : '' }}" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab" aria-controls="education" aria-selected="{{ $firstTab === 'education' ? 'true' : 'false' }}">
                                                {{ __('frontend.director_blog.education') }}
                                            </button>
                                        </li>
                                    @endif
                                    @if($hasCareer)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link{{ $firstTab === 'career' ? ' active' : '' }}" id="career-tab" data-bs-toggle="tab" data-bs-target="#career" type="button" role="tab" aria-controls="career" aria-selected="{{ $firstTab === 'career' ? 'true' : 'false' }}">
                                                {{ __('frontend.director_blog.career') }}
                                            </button>
                                        </li>
                                    @endif
                                    @if($hasAwards)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link{{ $firstTab === 'awards' ? ' active' : '' }}" id="awards-tab" data-bs-toggle="tab" data-bs-target="#awards" type="button" role="tab" aria-controls="awards" aria-selected="{{ $firstTab === 'awards' ? 'true' : 'false' }}">
                                                {{ __('frontend.director_blog.awards') }}
                                            </button>
                                        </li>
                                    @endif
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="directorInfoTabContent">
                                    @if($hasPersonalInfo)
                                        <div class="tab-pane fade{{ $firstTab === 'personal-info' ? ' show active' : '' }}" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                            <div class="director-section">
                                                <div class="section-content">
                                                    {!! nl2br(e($director->localized_personal_info)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($hasEducation)
                                        <div class="tab-pane fade{{ $firstTab === 'education' ? ' show active' : '' }}" id="education" role="tabpanel" aria-labelledby="education-tab">
                                            <div class="director-section">
                                                <div class="section-content">
                                                    {!! nl2br(e($director->localized_education)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($hasCareer)
                                        <div class="tab-pane fade{{ $firstTab === 'career' ? ' show active' : '' }}" id="career" role="tabpanel" aria-labelledby="career-tab">
                                            <div class="director-section">
                                                <div class="section-content">
                                                    {!! nl2br(e($director->localized_career)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($hasAwards)
                                        <div class="tab-pane fade{{ $firstTab === 'awards' ? ' show active' : '' }}" id="awards" role="tabpanel" aria-labelledby="awards-tab">
                                            <div class="director-section">
                                                <div class="section-content">
                                                    {!! nl2br(e($director->localized_awards)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i>
                            <p class="mb-0">{{ __('frontend.director_blog.no_director_info') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Questions to Director Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class="section-title mb-4">{{ __('frontend.director_blog.questions_title') }}</h2>
                </div>
            </div>

            <div class="row">
                <!-- Form Section -->
                <div class="col-lg-5">
                    <div class="director-question-form-card">
                        <h2 class="form-title">{{ __('frontend.director_blog.form_title') }}</h2>
                        <p class="form-subtitle">{{ __('frontend.director_blog.form_subtitle') }}</p>

                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('director-blog.store-question') }}" method="POST" class="director-question-form">
                            @csrf
                            <div class="form-group">
                                <label for="director_question_name" class="form-label">
                                    <i class="bi bi-person"></i> {{ __('frontend.director_blog.name_label') }} <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="director_question_name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required
                                    placeholder="{{ __('frontend.director_blog.name_placeholder') }}"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="director_question_email" class="form-label">
                                    <i class="bi bi-envelope"></i> {{ __('frontend.director_blog.email_label') }} <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="director_question_email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    placeholder="{{ __('frontend.director_blog.email_placeholder') }}"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="director_question_text" class="form-label">
                                    <i class="bi bi-question-circle"></i> {{ __('frontend.director_blog.question_label') }} <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                    class="form-control @error('question') is-invalid @enderror" 
                                    id="director_question_text" 
                                    name="question" 
                                    rows="6" 
                                    required
                                    placeholder="{{ __('frontend.director_blog.question_placeholder') }}"
                                >{{ old('question') }}</textarea>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="director_question_notify" 
                                        name="notify_email" 
                                        value="1"
                                        {{ old('notify_email') ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="director_question_notify">
                                        <i class="bi bi-bell"></i> {{ __('frontend.director_blog.notify_label') }}
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send"></i>
                                {{ __('frontend.director_blog.submit_button') }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Q&A List Section -->
                <div class="col-lg-7">
                    <div class="director-qa-list">
                        @if($questions->isNotEmpty())
                            <div class="accordion" id="directorQuestionsAccordion">
                                @foreach($questions as $question)
                                    <div class="accordion-item director-qa-accordion-item">
                                        <h2 class="accordion-header" id="directorHeading{{ $question->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#directorCollapse{{ $question->id }}" aria-expanded="false" aria-controls="directorCollapse{{ $question->id }}">
                                                <div class="director-qa-question-header">
                                                    <i class="bi bi-question-circle-fill"></i>
                                                    <span class="director-qa-question-text">{{ $question->question }}</span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="directorCollapse{{ $question->id }}" class="accordion-collapse collapse" aria-labelledby="directorHeading{{ $question->id }}" data-bs-parent="#directorQuestionsAccordion">
                                            <div class="accordion-body">
                                                <div class="director-qa-question-meta">
                                                    <div class="director-qa-question-author">
                                                        <i class="bi bi-person"></i>
                                                        <span>{{ $question->name }}</span>
                                                    </div>
                                                    <div class="director-qa-date">
                                                        <i class="bi bi-calendar"></i>
                                                        <span>{{ $question->created_at->format('d.m.Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="director-qa-answer">
                                                    <div class="director-qa-answer-header">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <h5>{{ __('frontend.director_blog.answer_label') }}</h5>
                                                    </div>
                                                    <p>{{ $question->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <p class="mb-0">{{ __('frontend.director_blog.no_questions') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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

        /* Director Blog Section */
        .director-blog {
            padding: 40px 0;
            background: #fff;
        }

        .director-photo-wrapper {
            margin-bottom: 30px;
        }

        .director-photo {
            width: 100%;
            border-radius: 8px;
        }

        .director-photo-placeholder {
            width: 100%;
            aspect-ratio: 3/4;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #adb5bd;
            font-size: 120px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .director-info {
            padding: 0;
        }

        .director-name {
            font-size: 28px;
            font-weight: 700;
            color: #212529;
            margin: 0 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        .director-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .director-detail i {
            color: #FFC107;
            font-size: 18px;
        }

        /* Director Tabs */
        .director-tabs {
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 25px;
            gap: 8px;
        }

        .director-tabs .nav-item {
            margin-bottom: 0;
        }

        .director-tabs .nav-link {
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14px;
            color: #6c757d;
            background: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            border-radius: 0;
            transition: all 0.3s ease;
            font-family: "Montserrat", sans-serif;
            text-shadow: none;
            -webkit-text-stroke: 0;
            -webkit-font-smoothing: antialiased;
        }

        .director-tabs .nav-link:hover {
            color: #2c4964;
            background: transparent;
            border-bottom-color: #FFC107;
            text-shadow: none;
        }

        .director-tabs .nav-link.active {
            color: #2c4964;
            background: transparent;
            border-bottom-color: #FFC107;
            font-weight: 700;
            text-shadow: none;
        }

        .tab-content {
            padding: 20px 0;
        }

        .tab-pane {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .director-section {
            margin-bottom: 0;
        }

        .director-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 12px 0;
            font-family: "Montserrat", sans-serif;
        }

        .section-content {
            font-size: 15px;
            color: #495057;
            line-height: 1.7;
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

        [data-theme="dark"] .breadcrumb-item::after {
            color: #495057;
        }

        [data-theme="dark"] .director-blog {
            background: #1a1a1a;
        }

        [data-theme="dark"] .director-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-detail {
            color: #adb5bd;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .director-tabs {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .director-tabs .nav-link {
            color: #adb5bd;
            text-shadow: none;
        }

        [data-theme="dark"] .director-tabs .nav-link:hover {
            color: #e0e0e0;
            border-bottom-color: #FFC107;
            text-shadow: none;
        }

        [data-theme="dark"] .director-tabs .nav-link.active {
            color: #e0e0e0;
            border-bottom-color: #FFC107;
            text-shadow: none;
        }

        [data-theme="dark"] .section-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .section-content {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-photo-placeholder {
            background: #2a2a2a;
            border-color: rgba(255, 255, 255, 0.1);
            color: #495057;
        }

        /* Director Questions Section - Same styles as regular questions */
        .director-question-form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            position: sticky;
            top: 20px;
        }

        .director-question-form-card .form-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form-card .form-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .director-question-form .form-group {
            margin-bottom: 20px;
        }

        .director-question-form .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #2c4964;
            margin-bottom: 8px;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form .form-label i {
            color: #FFC107;
            font-size: 16px;
        }

        .director-question-form .form-control {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .director-question-form .form-control:focus {
            border-color: #FFC107;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .director-question-form .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
        }

        .director-question-form .form-check-input {
            width: 20px;
            height: 20px;
            margin: 0;
            cursor: pointer;
            border: 2px solid #dee2e6;
            border-radius: 4px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .director-question-form .form-check-input:checked {
            background-color: #FFC107;
            border-color: #FFC107;
        }

        .director-question-form .form-check-input:focus {
            border-color: #FFC107;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }

        .director-question-form .form-check-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #2c4964;
            cursor: pointer;
            font-family: "Montserrat", sans-serif;
            margin: 0;
        }

        .director-question-form .form-check-label i {
            color: #FFC107;
            font-size: 16px;
        }

        .director-question-form .btn-submit {
            width: 100%;
            background: #FFC107;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-family: "Montserrat", sans-serif;
        }

        .director-question-form .btn-submit:hover {
            background: #d4a000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 160, 0, 0.3);
        }

        .director-question-form .btn-submit i {
            font-size: 18px;
        }

        /* Director Q&A List - Accordion styles */
        .director-qa-list {
            padding-left: 30px;
        }

        /* Accordion Styles */
        #directorQuestionsAccordion {
            --bs-accordion-border-color: #e5e7eb;
            --bs-accordion-border-radius: 12px;
            --bs-accordion-inner-border-radius: 12px;
        }

        .director-qa-accordion-item {
            border: none;
            margin-bottom: 16px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        #directorQuestionsAccordion .accordion-button {
            background: #fff;
            border: none;
            padding: 20px 24px;
            font-weight: 500;
            color: #2c4964;
            font-size: 15px;
            box-shadow: none;
        }

        #directorQuestionsAccordion .accordion-button:not(.collapsed) {
            background: #f8f9fa;
            color: #2c4964;
            box-shadow: none;
        }

        #directorQuestionsAccordion .accordion-button:focus {
            border-color: transparent;
            box-shadow: none;
        }

        #directorQuestionsAccordion .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232c4964'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            margin-left: auto;
            content: "";
            background-repeat: no-repeat;
            background-size: 1.25rem;
            transition: transform 0.2s ease-in-out;
        }

        #directorQuestionsAccordion .accordion-button:not(.collapsed)::after {
            transform: rotate(-180deg);
        }

        .director-qa-question-header {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            text-align: left;
        }

        .director-qa-question-header i {
            color: #FFC107;
            font-size: 20px;
            flex-shrink: 0;
        }

        .director-qa-question-text {
            font-size: 15px;
            font-weight: 500;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
            line-height: 1.5;
        }

        #directorQuestionsAccordion .accordion-body {
            padding: 20px 24px !important;
            background: #fff !important;
            color: #2c4964 !important;
        }

        #directorQuestionsAccordion .accordion-collapse {
            background: #fff !important;
        }

        #directorQuestionsAccordion .accordion-body * {
            visibility: visible !important;
            opacity: 1 !important;
        }

        .director-qa-question-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .director-qa-question-author {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 13px;
        }

        .director-qa-question-author i {
            color: #FFC107;
            font-size: 14px;
        }

        .director-qa-date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 12px;
        }

        .director-qa-date i {
            font-size: 14px;
        }

        .director-qa-answer {
            padding-top: 0;
        }

        .director-qa-answer-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .director-qa-answer-header i {
            color: #22c55e;
            font-size: 18px;
        }

        .director-qa-answer-header h5 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
            color: #2c4964;
            font-family: "Montserrat", sans-serif;
        }

        .director-qa-answer p {
            color: #495057;
            line-height: 1.7;
            margin: 0;
            font-size: 14px;
        }

        [data-theme="dark"] .director-question-form-card {
            background: #2a2a2a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .director-question-form .form-label {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form .form-control {
            background: #333333;
            border-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form .form-control:focus {
            border-color: #FFC107;
            background: #3a3a3a;
        }

        [data-theme="dark"] .director-question-form .form-control::placeholder {
            color: #6c757d;
        }

        [data-theme="dark"] .director-question-form .form-check-input {
            background-color: #333333;
            border-color: rgba(255, 255, 255, 0.2);
        }

        [data-theme="dark"] .director-question-form .form-check-input:checked {
            background-color: #FFC107;
            border-color: #FFC107;
        }

        [data-theme="dark"] .director-question-form .form-check-label {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-qa-list {
            padding-left: 0;
        }

        [data-theme="dark"] .director-qa-accordion-item {
            background: #2a2a2a;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] #directorQuestionsAccordion .accordion-button {
            background: #2a2a2a;
            color: #e0e0e0;
        }

        [data-theme="dark"] #directorQuestionsAccordion .accordion-button:not(.collapsed) {
            background: #333333;
            color: #e0e0e0;
        }

        [data-theme="dark"] #directorQuestionsAccordion .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e0e0e0'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        [data-theme="dark"] .director-qa-question-text {
            color: #e0e0e0;
        }

        [data-theme="dark"] #directorQuestionsAccordion .accordion-body {
            background: #2a2a2a !important;
            color: #e0e0e0 !important;
        }

        [data-theme="dark"] #directorQuestionsAccordion .accordion-collapse {
            background: #2a2a2a !important;
        }

        [data-theme="dark"] .director-qa-question-meta {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .director-qa-question-author {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-qa-question-author span,
        [data-theme="dark"] .director-qa-date span {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-qa-date {
            color: #6c757d;
        }

        [data-theme="dark"] .director-qa-answer-header h5 {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-qa-answer p {
            color: #adb5bd;
        }

        [data-theme="dark"] .director-question-form-card .form-title {
            color: #e0e0e0;
        }

        [data-theme="dark"] .director-question-form-card .form-subtitle {
            color: #adb5bd;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .alert-info {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            color: #004085;
        }

        .alert i {
            font-size: 20px;
            flex-shrink: 0;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        [data-theme="dark"] .alert-success {
            background: #064e3b;
            border-color: #047857;
            color: #d1fae5;
        }

        [data-theme="dark"] .alert-danger {
            background: #7f1d1d;
            border-color: #991b1b;
            color: #fee2e2;
        }

        [data-theme="dark"] .alert-info {
            background: #1e3a5f;
            border-color: #1e40af;
            color: #dbeafe;
        }

        @media (max-width: 991px) {
            .director-name {
                font-size: 24px;
            }

            .director-photo-wrapper {
                margin-bottom: 25px;
            }

            .director-tabs {
                flex-wrap: wrap;
                gap: 4px;
            }

            .director-tabs .nav-link {
                padding: 10px 16px;
                font-size: 13px;
            }

            .director-qa-list {
                padding-left: 0;
                margin-top: 30px;
            }

            .director-question-form-card {
                position: static;
            }
        }
    </style>
    @endpush
@endsection

