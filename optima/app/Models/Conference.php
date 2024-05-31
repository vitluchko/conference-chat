<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'start_date', 'end_date', 'isActive', 'description'];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'conference_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'conference_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'conference_id');
    }
}
