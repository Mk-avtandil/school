<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class Teacher extends Model
{
    use HasMedias;

    protected $fillable = [
        'published',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'phone',
        'email'
    ];
}
