<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\TracksUserActivity;

class Budget extends Model
{
    use HasFactory, TracksUserActivity;

    protected $fillable = [
        'user_id',
        'amount',
        'month_year',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'month_year' => 'date:Y-m',
        'is_active' => 'boolean',
    ];
}
