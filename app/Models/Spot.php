<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaccinations;

class Spot extends Model
{
    use HasFactory;

    protected $hidden = [
        'vaccination_id',
        'created_at',
        'updated_at',
    ];
    
    public function vaccination(){
        return $this->belongsTo(Vaccinations::class);
    }
}
