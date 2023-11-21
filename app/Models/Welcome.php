<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    use HasFactory;

    protected $fillable = [
        'top_img_count',
        'welcome_eng_msg',
        'welcome_jp_msg',
    ];
}
