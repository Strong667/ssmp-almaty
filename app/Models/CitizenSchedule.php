<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CitizenSchedule extends Model
{
    protected $fillable = [
        'full_name',
        'position',
        'position_kk',
        'day',
        'time_from',
        'time_to',
    ];

    public function getLocalizedPositionAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->position_kk) {
            return $this->position_kk;
        }

        return $this->position;
    }

    public function getLocalizedDayAttribute(): string
    {
        if (!$this->day) {
            return '';
        }

        $days = [
            'ru' => [
                'monday' => 'Понедельник',
                'tuesday' => 'Вторник',
                'wednesday' => 'Среда',
                'thursday' => 'Четверг',
                'friday' => 'Пятница',
                'saturday' => 'Суббота',
                'sunday' => 'Воскресенье',
            ],
            'kk' => [
                'monday' => 'Дүйсенбі',
                'tuesday' => 'Сейсенбі',
                'wednesday' => 'Сәрсенбі',
                'thursday' => 'Бейсенбі',
                'friday' => 'Жұма',
                'saturday' => 'Сенбі',
                'sunday' => 'Жексенбі',
            ],
        ];

        $locale = app()->getLocale();
        $dayKey = strtolower($this->day);

        return $days[$locale][$dayKey] ?? $this->day;
    }

    public function getFormattedTimeAttribute(): string
    {
        if (!$this->time_from || !$this->time_to) {
            return '';
        }

        // Обрабатываем time_from
        $from = $this->time_from;
        if (!is_string($from) || !preg_match('/^\d{2}:\d{2}$/', $from)) {
            try {
                $from = Carbon::parse($this->time_from)->format('H:i');
            } catch (\Exception $e) {
                $from = $this->time_from;
            }
        }
        
        // Обрабатываем time_to
        $to = $this->time_to;
        if (!is_string($to) || !preg_match('/^\d{2}:\d{2}$/', $to)) {
            try {
                $to = Carbon::parse($this->time_to)->format('H:i');
            } catch (\Exception $e) {
                $to = $this->time_to;
            }
        }

        if (app()->getLocale() === 'kk') {
            return $from . ' - ' . $to;
        }

        return 'с ' . $from . ' до ' . $to;
    }
}
