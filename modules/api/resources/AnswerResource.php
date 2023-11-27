<?php

namespace app\modules\api\resources;

use app\models\Answer;
use yii\web\NotFoundHttpException;

class AnswerResource extends Answer
{
    /**
     * Creates a new answer associated with a response and a question.
     * @param int $responseId
     * @param int $questionId
     * @param array $data
     * @return mixed
     */
    public static function createAnswer($responseId, $questionId, $data)
    {
        $response = ResponseResource::findOne($responseId);
        $question = QuestionResource::findOne($questionId);

        if ($response === null || $question === null) {
            throw new NotFoundHttpException("Response or Question not found: $responseId and $questionId");
        }

        $model = new self();
        $model->load($data, '');
        $model->response_id = $responseId;
        $model->question_id = $questionId;

        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }
}