<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTruck extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_truck_img',
        'food_truck_text',
    ];
}
