<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'conference_id', 'name', 'description', 'image_path', 'slug'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id');
    }
}
