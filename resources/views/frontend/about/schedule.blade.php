@extends('frontend.layouts.app')

@section('title', 'График приёма граждан')

@section('content')
    <!-- Schedule Section -->
    <section id="schedule" class="schedule section">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>График приёма граждан</h2>
                <p>Расписание приёма руководящего состава</p>
            </header>

            @if($schedules->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-calendar-event"></i>
                    <p>График приёма граждан пока не добавлен</p>
                </div>
            @else
                <div class="schedule-container">
                    @php
                        // Группируем по дням недели
                        $groupedSchedules = $schedules->groupBy('day');
                        // Порядок дней недели
                        $dayOrder = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
                    @endphp

                    @foreach($dayOrder as $day)
                        @if($groupedSchedules->has($day))
                            <div class="schedule-day-group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <h3 class="schedule-day-title">
                                    <i class="bi bi-calendar-day"></i>
                                    {{ $day }}
                                </h3>
                                <div class="schedule-items">
                                    @foreach($groupedSchedules->get($day) as $schedule)
                                        <div class="schedule-item">
                                            <div class="schedule-info">
                                                <h4 class="schedule-name">{{ $schedule->full_name }}</h4>
                                                <p class="schedule-position">{{ $schedule->position }}</p>
                                            </div>
                                            <div class="schedule-time">
                                                <i class="bi bi-clock"></i>
                                                <span>{{ $schedule->time }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- Показываем дни, которых нет в стандартном порядке --}}
                    @foreach($groupedSchedules as $day => $daySchedules)
                        @if(!in_array($day, $dayOrder))
                            <div class="schedule-day-group" data-aos="fade-up">
                                <h3 class="schedule-day-title">
                                    <i class="bi bi-calendar-day"></i>
                                    {{ $day }}
                                </h3>
                                <div class="schedule-items">
                                    @foreach($daySchedules as $schedule)
                                        <div class="schedule-item">
                                            <div class="schedule-info">
                                                <h4 class="schedule-name">{{ $schedule->full_name }}</h4>
                                                <p class="schedule-position">{{ $schedule->position }}</p>
                                            </div>
                                            <div class="schedule-time">
                                                <i class="bi bi-clock"></i>
                                                <span>{{ $schedule->time }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Schedule Section */
        .schedule {
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

        .schedule-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .schedule-day-group {
            margin-bottom: 40px;
        }

        .schedule-day-group:last-child {
            margin-bottom: 0;
        }

        .schedule-day-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c4964;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1977cc;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .schedule-day-title i {
            color: #1977cc;
            font-size: 28px;
        }

        .schedule-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .schedule-item {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 4px solid #1977cc;
        }

        .schedule-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .schedule-info {
            flex: 1;
        }

        .schedule-name {
            font-size: 18px;
            font-weight: 600;
            color: #2c4964;
            margin: 0 0 8px 0;
        }

        .schedule-position {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        .schedule-time {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: #1977cc;
            white-space: nowrap;
        }

        .schedule-time i {
            font-size: 18px;
        }

        /* Dark Theme */
        [data-theme="dark"] .schedule {
            background: #1a1a1a;
        }

        [data-theme="dark"] .schedule-day-title {
            color: #e0e0e0;
            border-bottom-color: #1977cc;
        }

        [data-theme="dark"] .schedule-item {
            background: #2a2a2a;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.5);
            border-left-color: #1977cc;
        }

        [data-theme="dark"] .schedule-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
        }

        [data-theme="dark"] .schedule-name {
            color: #e0e0e0;
        }

        [data-theme="dark"] .schedule-position {
            color: #b0b0b0;
        }

        [data-theme="dark"] .schedule-time {
            background: #1a1a1a;
            color: #1977cc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .schedule {
                padding: 100px 0 60px;
            }

            .schedule-day-title {
                font-size: 20px;
            }

            .schedule-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .schedule-time {
                width: 100%;
                justify-content: center;
            }

            .schedule-day-group {
                margin-bottom: 30px;
            }
        }
    </style>
    @endpush
@endsection

