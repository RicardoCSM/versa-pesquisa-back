<?php

namespace app\modules\api\resources;

use app\models\Question;
use yii\web\NotFoundHttpException;

class QuestionResource extends Question
{
    /**
     * Creates a new question associated with a survey and a page.
     * @param int $surveyId
     * @param int $pageId
     * @param array $data
     * @return mixed
     */
    public static function createQuestion($surveyId, $pageId, $data)
    {
        $survey = SurveyResource::findOne($surveyId);
        $page = PageResource::findOne($pageId);

        if ($survey === null || $page === null) {
            throw new NotFoundHttpException("Survey or Page not found: $surveyId and $pageId");
        }

        $model = new self();
        $model->load($data, '');
        $model->survey_id = $surveyId;
        $model->page_id = $pageId;

        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }
}