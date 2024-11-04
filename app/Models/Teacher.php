<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function homeworks(): hasMany
    {
        return $this->hasMany(Homework::class);
    }
}
