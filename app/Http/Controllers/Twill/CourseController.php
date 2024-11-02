<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Files;
use A17\Twill\Services\Forms\Fields\MultiSelect;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use App\Models\Student;
use App\Models\Teacher;
use A17\Twill\Services\Forms\Options;

class CourseController extends BaseModuleController
{
    protected $moduleName = 'courses';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->enableSkipCreateModal();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('title')->label('Title')
        );

        $form->add(
            Wysiwyg::make()->name('description')->label('Description')
        );

        $form->add(
            Input::make()->name('price')->label('Price')
        );

        $form->add(
            Select::make()
                ->name('teacher_id')
                ->label('Teacher')
                ->options(Options::make(
                    Teacher::all('id', 'first_name', 'last_name')->mapWithKeys(function ($item) {
                        return [$item->id => $item->first_name . ' ' . $item->last_name];
                    }
                ))->toArray())
        );

        $form->add(
            Files::make()
                ->name('files')
                ->label('Files')
                ->note('Add files')
        );

        $form->add(
            MultiSelect::make()
                ->name('students')
                ->label('Students')
                ->options(Options::make(
                    Student::all('id', 'first_name')->mapWithKeys(function ($item) {
                        return [$item->id => $item->first_name];
                    })
                )->toArray())
        );



        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('price')->title('Price')
        );

        $table->add(
            Text::make()->field('teacher_id')->title('Teacher')->customRender(function ($teacher) {
                $user = Teacher::find($teacher->teacher_id);
                return $user ? $user->first_name : 'Unknown';
            }),
        );

        return $table;
    }
}
