<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id', 
        'jury_id', 
        'audiovisuel', 
        'scenario', 
        'appreciation'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
        
        

    public function jury()
    {
        return $this->belongsTo(User::class, 'jury_id');
    }
}
