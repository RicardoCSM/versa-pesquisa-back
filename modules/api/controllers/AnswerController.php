<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\AnswerResource;
use yii\rest\ActiveController;

class AnswerController extends ActiveController
{
    public $modelClass = AnswerResource::class;
}