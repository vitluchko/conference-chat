<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'conference_id', 'name', 'description', 'image_path', 'slug'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
}
