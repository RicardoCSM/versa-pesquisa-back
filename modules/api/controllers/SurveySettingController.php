<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveySettingResource;
use app\modules\api\controllers\BaseController;

class SurveySettingController extends BaseController
{
    public $modelClass = SurveySettingResource::class;

}