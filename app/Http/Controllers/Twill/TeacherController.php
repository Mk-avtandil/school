<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Radios;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\DatePicker;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class TeacherController extends BaseModuleController
{
    protected $moduleName = 'teachers';
    protected $titleColumnKey = 'first_name';
    protected $titleColumnLabel = 'First name';
    protected $titleFormKey = 'first_name';
    protected $titleFormLabel = 'First name';

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
            Input::make()
                ->name('first_name')
                ->label('First name')
                ->required(),
        );

        $form->add(
            Input::make()
                ->name('last_name')
                ->label('Last name')
                ->required(),
        );

        $form->add(
            DatePicker::make()
                ->name("birthday")
                ->label("Birthday")
                ->withoutTime()
                ->required(),
        );

        $form->add(
            Radios::make()
            ->name('gender')
            ->default('man')
            ->options([
                Option::make('man', 'Man'),
                Option::make('woman', 'Woman')
            ])
        );

        $form->add(
            Input::make()
                ->name('phone')
                ->label('Phone number')
                ->required(),
        );

        $form->add(
            Input::make()
                ->name('email')
                ->label('Email')
                ->required(),
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
            Text::make()->field('last_name')->title('Last name')
        );

        $table->add(
            Text::make()->field('birthday')->title('Birthday')
        );

        $table->add(
            Text::make()->field('email')->title('Email')
        );

        return $table;
    }
}
