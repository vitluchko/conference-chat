<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'conference_id', 'start_time', 'end_time', 'event'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id');
    }
}
