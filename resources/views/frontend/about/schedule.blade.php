@extends('frontend.layouts.app')

@section('title', 'График приёма граждан')

@section('content')
    <section class="section">
        <div class="container">
            <header class="section-header">
                <h2>График приёма граждан</h2>
            </header>

            @if($schedules->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ФИО</th>
                                <th>Должность</th>
                                <th>День</th>
                                <th>Время</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->full_name }}</td>
                                    <td>{{ $schedule->position }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ $schedule->time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <p>График приёма граждан пока не добавлен</p>
                </div>
            @endif
        </div>
    </section>
@endsection
