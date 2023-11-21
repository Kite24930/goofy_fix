<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'link_url',
    ];
}
