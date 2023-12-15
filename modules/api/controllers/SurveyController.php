<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\SurveyResource;
use app\modules\api\controllers\BaseController;
use app\modules\api\resources\SurveySettingResource;
use app\modules\api\resources\ThemeResource;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class SurveyController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = SurveyResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Unset the authenticator for the 'getDetails' action
        $behaviors['authenticator']['except'] = ['details'];

        return $behaviors;
    }

    /**
     * Customizes the default actions for the controller.
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        unset($actions['create']);
        unset($actions['delete']);

        return $actions;
    }

    /**
     * Prepares the data provider for the index action.
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->byUser(Yii::$app->user->id),
            'pagination' => [
                'pageSize' => 6,
            ],
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
            'questions' => $survey->getQuestions()->all(),
            'settings' => $survey->getSetting()->one(),
            'theme' => $survey->getTheme()->one()
        ];
    }

    /**
     * Action to get survey-settings by survey_ids.
     *
     * @param $id
     * @return array
     */
    public function actionSurveySettings($survey_id)
    {
        $survey = $this->findModel($survey_id);
        $surveyOptions = SurveySettingResource::find()->where(['id' => $survey->id])->one();

        return $surveyOptions;
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
     * Creates a new survey.
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

    /**
     * Deletes a survey.
     * @return mixed
     * @throws NotFoundHttpException if the survey is not found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->deleteRelatedRecords($model);

        $model->delete();

        $response = Yii::$app->getResponse();
        $response->setStatusCode(204);

        return $response;
    }

    /**
     * Delete related records from themes and settings.
     *
     * @param SurveyResource $survey
     */
    protected function deleteRelatedRecords($survey)
    {
        $themeId = $survey->theme_id;
        $settingId = $survey->setting_id;

        if ($themeId !== null) {
            ThemeResource::deleteAll(['id' => $themeId]);
        }

        if ($settingId !== null) {
            SurveySettingResource::deleteAll(['id' => $settingId]);
        }
    }
    
}
