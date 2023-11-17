<?php

namespace app\modules\api\models;

use app\modules\api\resources\UserResource;

class LoginForm extends \app\models\LoginForm
{
    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserResource::findByEmail($this->email);
        }

        return $this->_user;
    }
}