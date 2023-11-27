<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ThemeResource;
use app\modules\api\controllers\BaseController;

class ThemeController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = ThemeResource::class;
}