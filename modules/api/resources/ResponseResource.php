<?php

namespace app\modules\api\resources;

use app\models\Response;
use yii\web\NotFoundHttpException;

class ResponseResource extends Response
{
    /**
     * Creates a new response associated with a survey.
     * @param int $surveyId
     * @param array $data
     * @return mixed
     */
    public static function createResponse($surveyId, $data)
    {
        $survey = SurveyResource::findOne($surveyId);

        if ($survey === null) {
            throw new NotFoundHttpException("Survey not found: $surveyId");
        }

        $model = new self();
        $model->load($data, '');
        $model->survey_id = $surveyId;

        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }
}