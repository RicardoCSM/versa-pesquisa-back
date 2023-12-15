<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\QuestionResource;
use app\modules\api\controllers\BaseController;
use app\modules\api\resources\QuestionOptionResource;
use yii\web\NotFoundHttpException;

class QuestionController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = QuestionResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Unset the authenticator for the 'getDetails' action
        $behaviors['authenticator']['except'] = ['question-options'];

        return $behaviors;
    }

    /**
     * Action to get question-options by question_ids.
     *
     * @param $id
     * @return array
     */
    public function actionQuestionOptions($question_id)
    {
        $questionOptions = QuestionOptionResource::find()->where(['question_id' => $question_id])->all();

        return $questionOptions;
    }

    /**
     * Action to get details of a question.
     *
     * @param $survey_id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionDetails($survey_id)
    {
        $questions = QuestionResource::find()->where(['survey_id' => $survey_id])->all();

        if (empty($questions)) {
            throw new NotFoundHttpException('No questions found for the specified survey_id.');
        }

        $details = [];

        foreach ($questions as $question) {
            $questionDetails = [
                'question_id' => $question->id,
                'question_title' => $question->title,
                'question_type' => $question->type,
                'answers' => $question->getAnswers($question->id)->all()
            ];

            if ($question->type === 'multipleChoice') {
                $questionDetails['question_options'] = $question->getQuestionOptions($question->id)->all();
            }

            $details[] = $questionDetails;
        }

        return $details;
    }
}