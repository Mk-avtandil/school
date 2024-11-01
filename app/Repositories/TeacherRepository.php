<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Teacher;

class TeacherRepository extends ModuleRepository
{
    use HandleMedias;

    public function __construct(Teacher $model)
    {
        $this->model = $model;
    }
}
