<?php

namespace app\modules\api\controllers;

use app\modules\api\models\LoginForm;
use app\modules\api\models\SignupForm;
use app\modules\api\resources\UserResource;
use Yii;
use yii\rest\Controller;
use yii\web\UnauthorizedHttpException;

class UserController extends Controller
{
    /**
     * Logs in a user.
     *
     * @return mixed User data if login is successful, otherwise an array of errors.
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            return $model->getUser();
        }
        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }

    /**
     * Registers a new user.
     *
     * @return mixed User data if registration is successful, otherwise an array of errors.
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->register()) {
            return $model->_user;
        }
        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }

    /**
     * Retrieves user data based on the provided access token.
     *
     * @return mixed User data if access token is valid, otherwise throw UnauthorizedHttpException.
     * @throws UnauthorizedHttpException If access token is not provided or invalid.
     */
    public function actionGetData()
    {
        $headers = Yii::$app->request->headers;
        if (!isset($headers['Authorization'])){
            throw new UnauthorizedHttpException();
        }
        $accessToken = explode(" ", $headers['Authorization'])[1];
        $user = UserResource::findIdentityByAccessToken($accessToken);
        if (!$user){
            throw new UnauthorizedHttpException();
        }
        return $user;
    }
}