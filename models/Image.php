<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $path
 * @property int $size
 * @property yii\web\UploadedFile $imageFile
 */
class Image extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
            [['name', 'description', 'path'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
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
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ImageQuery(get_called_class());
    }
}
