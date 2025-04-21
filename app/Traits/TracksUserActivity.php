<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait TracksUserActivity
{
    public static function bootTracksUserActivity()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}