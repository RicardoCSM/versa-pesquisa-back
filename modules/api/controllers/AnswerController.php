<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\AnswerResource;
use yii\filters\Cors;
use yii\rest\ActiveController;

class AnswerController extends ActiveController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'cors' => Cors::class
        ]);
    }
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = AnswerResource::class;
}