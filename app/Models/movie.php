<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis', 
        'release_date', 
        'producer_id'
    ];

    public function producer()
    {
        return $this->belongsTo(User::class, 'producer_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
