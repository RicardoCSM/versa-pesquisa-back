<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveySettingResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class SurveySettingController extends ActiveController
{
    public $modelClass = SurveySettingResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }
}