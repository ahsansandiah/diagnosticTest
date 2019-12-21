<?php

namespace App\Http\Controllers;

use App\Steps\User\NameStep;
use App\Steps\User\EmailStep;
use Ycs77\LaravelWizard\Http\Controllers\WizardController;

class UserWizardController extends WizardController
{
    /**
     * The wizard name.
     *
     * @var string
     */
    protected $wizardName = 'user';

    /**
     * The wizard title.
     *
     * @var string
     */
    protected $wizardTitle = 'User';

    /**
     * The wizard options.
     *
     * Available options reference from Ycs77\LaravelWizard\Wizard::$optionsKeys.
     *
     * @var array
     */
    protected $wizardOptions = [];

    /**
     * The wizard steps instance.
     *
     * @var array
     */
    protected $steps = [
        NameStep::class,
        EmailStep::class,
    ];
}
