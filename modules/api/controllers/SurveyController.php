<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveyResource;
use app\modules\api\controllers\BaseController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class SurveyController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = SurveyResource::class;

    /**
     * Customizes the default actions for the controller.
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        unset($actions['create']);

        return $actions;
    }

    /**
     * Prepares the data provider for the index action.
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->byUser(Yii::$app->user->id)
        ]);
    }

    /**
     * Action to retrieve survey details with pages and questions.
     *
     * @param $id
     * @return array
     */
    public function actionDetails($id)
    {
        $survey = $this->findModel($id);

        return [
            'survey' => $survey,
            'pages' => $survey->getPages()->all(),
            'questions' => $survey->getQuestions()->all()
        ];
    }

    /**
     * Finds the Survey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     * @return Survey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested survey does not exist.');
        }
    }

    /**
     * Creates a new survey associated with a survey.
     * @return mixed
     * @throws NotFoundHttpException if the survey is not found
     */
    public function actionCreate()
    {
        $data = Yii::$app->getRequest()->getBodyParams();

        $result = SurveyResource::createSurvey($data);

        if (!is_array($result)) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        }

        return $result;
    }
    
}
