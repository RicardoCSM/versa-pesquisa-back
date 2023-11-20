<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%themes}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $primary_color
 * @property string|null $secondary_color
 * @property string|null $background_color
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 */
class Theme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%themes}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'primary_color', 'secondary_color', 'background_color'], 'string', 'max' => 255],
            [['created_at', 'created_by', 'updated_at'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'primary_color' => Yii::t('app', 'Primary Color'),
            'secondary_color' => Yii::t('app', 'Secondary Color'),
            'background_color' => Yii::t('app', 'Background Color'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ThemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ThemeQuery(get_called_class());
    }
}
