<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ResponseResource;
use yii\rest\ActiveController;

class ResponseController extends ActiveController
{
    public $modelClass = ResponseResource::class;
}