<?php

namespace App\Repositories;


use A17\Twill\Repositories\ModuleRepository;
use App\Models\Grade;

class GradeRepository extends ModuleRepository
{
    

    public function __construct(Grade $model)
    {
        $this->model = $model;
    }
}
