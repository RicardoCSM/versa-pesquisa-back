<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\PageResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class PageController extends ActiveController
{
    public $modelClass = PageResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }
}