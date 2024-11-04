<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasMedias, HasFiles, HasFactory;

    protected $fillable = [
        'published',
        'first_name',
        'last_name',
        'birthday',
        'address',
        'phone',
        'email'
    ];

    public function courses(): belongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function homeworks(): hasMany
    {
        return $this->hasMany(Homework::class);
    }
}
