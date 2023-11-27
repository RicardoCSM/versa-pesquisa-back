<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\AnswerResource;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class AnswerController extends ActiveController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = AnswerResource::class;
    
    /**
     * @var int The response ID and question ID
     */
    protected $responseId;
    protected $questionId;

    /**
     * Set the response ID and question ID before running an action.
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $this->responseId = Yii::$app->request->get('response_id');
        $this->questionId = Yii::$app->request->get('question_id');
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
            'query' => $this->modelClass::find()->fromResponseAndQuestion($this->responseId, $this->questionId),
        ]);
    }

    /**
     * Finds a model by ID for update, and delete actions.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model is not found
     */
    public function findModel($id)
    {
        $model = $this->modelClass::find()->withResponseAndQuestion($id, $this->responseId, $this->questionId);

        if ($model === null) {
            throw new NotFoundHttpException("Answer not found or not part of the response / question: $id");
        }

        return $model;
    }

    /**
     * Creates a new answer associated with a response and question.
     * @return mixed
     * @throws NotFoundHttpException if the response is not found
     */
    public function actionCreate()
    {
        $data = Yii::$app->getRequest()->getBodyParams();

        $result = AnswerResource::createAnswer($this->responseId, $this->questionId, $data);

        if (!is_array($result)) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        }

        return $result;
    }
}