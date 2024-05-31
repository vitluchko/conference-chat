<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'degree',
        'institution',
        'slug',
        'background_path',
        'profile_path',
    ];

    protected $attributes = [
        'country' => 'Country',
        'city' => 'City',
        'degree' => 'Degree',
        'institution' => 'Institution',
        'slug' => 'default',
        'background_path' => 'background-default.jpg',
        'profile_path' => 'default.jpg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
