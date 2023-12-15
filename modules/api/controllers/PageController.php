<?php

namespace app\modules\api\controllers;

use app\modules\api\controllers\BaseController;
use app\modules\api\resources\PageResource;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PageController extends BaseController
{
    /**
     * @var string the model class name. This property must be set in child classes.
     */
    public $modelClass = PageResource::class;

    /**
     * Finds the Page model based on its primary key value.
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Get the number of questions per page for a specific page.
     *
     * @param int $id Page ID
     * @return array
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionQuestionsPerPage($id)
    {
        $page = $this->findModel($id);

        if ($page === null) {
            throw new \yii\web\NotFoundHttpException("Page not found with ID: $id");
        }

        $questionsPerPage = $page->getQuestions()->count();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return ['questionsPerPage' => $questionsPerPage];
    }
}