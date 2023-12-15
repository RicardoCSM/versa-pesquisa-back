<?php

namespace app\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $auth = $behaviors['authenticator'];
        $auth['authMethods'] = [
            HttpBearerAuth::class
        ];
        unset($behaviors['authenticator']); 
        $behaviors['cors'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => ['X-Pagination-Total-Count'],
            ]
        ];
        $behaviors['authenticator'] = $auth;

        return $behaviors;
    }
}
