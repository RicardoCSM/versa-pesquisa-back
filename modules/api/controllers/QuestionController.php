<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\QuestionResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class QuestionController extends ActiveController
{
    public $modelClass = QuestionResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }
}