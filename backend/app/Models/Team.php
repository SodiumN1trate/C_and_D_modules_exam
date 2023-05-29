<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contactEmail',
        'plannedStartingTime',
        'startingTime',
        'accessCode',
    ];

    public function runners() {
        return $this->hasMany(Runner::class,'teamId');
    }
}
