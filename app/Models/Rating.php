<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['movie_id', 
    'jury_id', 
    'criteria', 
    'overall_score'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
