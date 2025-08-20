<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'price',
        'latitude',
        'longitude',
        'speed',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
