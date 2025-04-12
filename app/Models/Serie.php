<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_name',
        'user_photo_url',
        'published_at',
    ];

    public function testedBy(): string
    {
        return SerieTest::class;
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }


    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getFormattedForHumansCreatedAtAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getCreatedAtTimestampAttribute(): int
    {
        return $this->created_at->timestamp;
    }
}
