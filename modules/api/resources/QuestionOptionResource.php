<?php

namespace app\modules\api\resources;

use app\models\QuestionOption;
use yii\web\NotFoundHttpException;

class QuestionOptionResource extends QuestionOption
{
    /**
     * Creates a new question option associated with a question.
     * @param int $questionId
     * @param array $data
     * @return mixed
     */
    public static function createQuestionOption($questionId, $data)
    {
        $question = QuestionResource::findOne($questionId);

        if ($question === null) {
            throw new NotFoundHttpException("Question not found: $questionId");
        }

        $model = new self();
        $model->load($data, '');
        $model->question_id = $questionId;

        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }
}