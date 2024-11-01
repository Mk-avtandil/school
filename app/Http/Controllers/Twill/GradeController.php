<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;

class GradeController extends BaseModuleController
{
    protected $moduleName = 'grades';
    protected $titleColumnKey = 'grade';
    protected $titleColumnLabel = 'Grade';
    protected $titleFormKey = 'grade';
    protected $titleFormLabel = 'Grade';

    private static array $formFields;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->enableSkipCreateModal();

        self::$formFields = [
            Select::make()
                ->name('course_id')
                ->label('Course')
                ->required()
                ->options(Options::make(
                    Course::all('id', 'title')->mapWithKeys(function ($item) {
                        return [$item->id => $item->title];
                    }
                    ))->toArray()),

            Select::make()
                ->name('student_id')
                ->label('Student')
                ->required()
                ->options(Options::make(
                    Student::all('id', 'first_name', 'last_name')->mapWithKeys(function ($item) {
                        return [$item->id => $item->first_name . ' ' . $item->last_name];
                    }
                    ))->toArray()),

            Select::make()
                ->name('teacher_id')
                ->label('Teacher')
                ->required()
                ->options(Options::make(
                    Teacher::all('id', 'first_name', 'last_name')->mapWithKeys(function ($item) {
                        return [$item->id => $item->first_name . ' ' . $item->last_name];
                    }
                    ))->toArray()),

            Input::make()
                ->name('grade')
                ->label('Grade')
                ->required(),

            Wysiwyg::make()
                ->name('comment')
                ->label('Comment'),
        ];
    }

    public function getCreateForm(): Form
    {
        return Form::make(self::$formFields);
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        foreach (self::$formFields as $field) {
            $form->add($field);
        }

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = new TableColumns();

        $table->add(
            Text::make()->field('course_id')->title('Course')->customRender(function ($course) {
                $user = Course::find($course->course_id);
                return $user ? $user->title : 'Null';
            }),
        );

        $table->add(
            Text::make()->field('student_id')->title('Student')->customRender(function ($student) {
                $user = Student::find($student->teacher_id);
                return $user ? $user->first_name . ' ' . $user->last_name : 'Unknown';
            }),
        );

        $table->add(
            Text::make()->field('teacher_id')->title('Teacher')->customRender(function ($teacher) {
                $user = Teacher::find($teacher->teacher_id);
                return $user ? $user->first_name . ' ' . $user->last_name : 'Unknown';
            }),
        );

        return $table;
    }
}
