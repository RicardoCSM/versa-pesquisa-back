<?php

namespace app\modules\api\controllers;

use app\modules\api\controllers\BaseController;
use app\modules\api\resources\PageResource;
use app\modules\api\resources\SurveyResource;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PageController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = PageResource::class;

    /**
     * @var int The survey ID
     */
    protected $surveyId;

    /**
     * Set the survey ID before running an action.
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $this->surveyId = Yii::$app->request->get('survey_id');
        return parent::beforeAction($action);
    }

    /**
     * Customizes the default actions for the controller.
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        $actions['view']['findModel'] = [$this, 'findModel'];
        $actions['update']['findModel'] = [$this, 'findModel'];
        $actions['delete']['findModel'] = [$this, 'findModel'];

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
            'query' => $this->modelClass::find()->fromSurvey($this->surveyId),
        ]);
    }

    /**
     * Finds a page by ID for update, and delete actions.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the page is not found
     */
    public function findModel($id)
    {
        $model = $this->modelClass::find()->withSurvey($id, $this->surveyId);

        if ($model === null) {
            throw new NotFoundHttpException("Page not found or not part of the survey: $id");
        }

        return $model;
    }

    /**
     * Creates a new question associated with a survey.
     * @return mixed
     * @throws NotFoundHttpException if the survey is not found
     */
    public function actionCreate()
    {
        $data = Yii::$app->getRequest()->getBodyParams();

        try {
            $result = PageResource::createPage($this->surveyId, $data);
        } catch (NotFoundHttpException $e) {
            throw new NotFoundHttpException("Survey not found: $this->surveyId");
        }

        if (!is_array($result)) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        }

        return $result;
    }
}