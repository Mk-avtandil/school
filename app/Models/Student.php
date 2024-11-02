<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

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

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }
}
