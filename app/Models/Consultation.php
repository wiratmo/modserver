<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Consultation extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'disease_history',
        'current_symptoms',
    ];
}
