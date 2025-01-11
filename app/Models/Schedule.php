<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
    'movie_id', 
    'technician_id', 
    'salle', 
    'date',
    'start_time',
    'end_time'
    ];
   

    // Définir les relations avec les films et les techniciens
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
