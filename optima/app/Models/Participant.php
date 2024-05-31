<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'link',
        'user_id',
        'conference_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id');
    }
}
