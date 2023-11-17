<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class User
 * 
 * @property integer $id]
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $access_token
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->andWhere(['access_token' => $token])->one();
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByName($name)
    {
        return self::find()->andWhere(['name' => $name])->one();
    }

    /**
     * Finds user by lastname
     *
     * @param string $lastname
     * @return static|null
     */
    public static function findByLastname($lastname)
    {
        return self::find()->andWhere(['lastname' => $lastname])->one();
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::find()->andWhere(['email' => $email])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
