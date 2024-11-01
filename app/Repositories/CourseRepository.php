<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Course;

class CourseRepository extends ModuleRepository
{
    use HandleMedias, HandleFiles;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }
}
