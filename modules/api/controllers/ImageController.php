<?php

namespace app\modules\api\controllers;

use app\modules\api\resources\ImageResource;
use Yii;
use yii\rest\Controller;
use yii\web\UploadedFile;

class ImageController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::class,
            'actions' => [
                'upload'  => ['POST'],
                'delete' => ['DELETE'],
            ],
        ];
        return $behaviors;
    }

    public function actionUpload()
    {
        $model = new ImageResource();
        $model->description = Yii::$app->request->post('description');
        $model->imageFile = UploadedFile::getInstanceByName('imageFile');
        if ($model->uploadImage() && $model->save(false)) {
            return $model;
        }
        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }

    public function actionDelete($id)
    {
        $model = ImageResource::findOne($id);
        if ($model && $model->deleteImage() && $model->delete()) {
            Yii::$app->response->statusCode = 204;
            return;
        }
        return $model ? $model->errors : ['error' => 'Image not found'];
    }
}