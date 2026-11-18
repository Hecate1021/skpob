<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'event_date',
        'status'
    ];

    // Cast the event_date to a Carbon date object automatically
    protected $casts = [
        'event_date' => 'date',
    ];
}
