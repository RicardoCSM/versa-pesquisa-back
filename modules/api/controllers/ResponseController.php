<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use app\modules\api\resources\ResponseResource;
use yii\filters\Cors;

class ResponseController extends ActiveController
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
    public $modelClass = ResponseResource::class;

    /**
     * Action to get responses by survey_id.
     *
     * @param $id
     * @return array
     */
    public function actionPerSurvey($survey_id)
    {
        $responsesPerSurvey = ResponseResource::find()->where(['survey_id' => $survey_id])->all();

        return $responsesPerSurvey;
    }
}