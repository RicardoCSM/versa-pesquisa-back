<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveyResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class SurveyController extends ActiveController
{
    public $modelClass = SurveyResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['view'],
        ];

        return $behaviors;
    }
}