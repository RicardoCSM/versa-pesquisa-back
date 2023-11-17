<?php

namespace app\modules\api\models;

use app\modules\api\resources\UserResource;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $password_repeat;

    public $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields are both required
            [['name', 'email', 'password', 'lastname', 'password_repeat'], 'required'],
            // email must be a email value
            ['email', 'email'],
            // password and password_repeat must be equal
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            // email must be unique
            ['email', 'unique',
                'targetClass' => '\app\modules\api\resources\UserResource',
                'message' => 'This email address has already been taken.'
            ],
        ];
    }

    /**
     * Register a user in the database  based on the data provided.
     * @return bool whether the user is registered in successfully
     */
    public function register()
    {            
        $this->_user = new UserResource();
        if ($this->validate()) {
            $security = Yii::$app->security;
            $this->_user->name = $this->name;
            $this->_user->lastname = $this->lastname;
            $this->_user->email = $this->email;
            $this->_user->password = $security->generatePasswordHash($this->password);
            $this->_user->access_token = $security->generateRandomString(255);

            if($this->_user->save()) {
                return true;
            }
            return false;
        }
        return false;
    }
}