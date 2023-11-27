<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveySettingResource;
use app\modules\api\controllers\BaseController;

class SurveySettingController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = SurveySettingResource::class;
}