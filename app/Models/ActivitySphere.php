<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySphere extends Model
{
    protected $fillable = [
        'general_info',
        'general_info_kk',
        'mission',
        'mission_kk',
        'goal',
        'goal_kk',
        'history',
        'history_kk',
    ];

    public function getLocalizedGeneralInfoAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->general_info_kk) {
            return $this->general_info_kk;
        }

        return $this->general_info;
    }

    public function getLocalizedMissionAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->mission_kk) {
            return $this->mission_kk;
        }

        return $this->mission;
    }

    public function getLocalizedGoalAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->goal_kk) {
            return $this->goal_kk;
        }

        return $this->goal;
    }

    public function getLocalizedHistoryAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->history_kk) {
            return $this->history_kk;
        }

        return $this->history;
    }
}
