<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasMedias, HasFiles, HasFactory;

    protected $fillable = [
        'published',
        'title',
        'description',
        'price',
        'teacher_id',
    ];

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }
}
