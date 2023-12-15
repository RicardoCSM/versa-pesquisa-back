<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%question_options}}".
 *
 * @property int $id
 * @property int $question_id
 * @property string $option_text
 * @property int $position
 *
 * @property Logic[] $logics
 * @property Question $question
 */
class QuestionOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%question_options}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id'], 'required'],
            [['question_id', 'position'], 'integer'],
            [['option_text'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'option_text' => Yii::t('app', 'Option Text'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * Gets query for [[Logics]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\LogicQuery
     */
    public function getLogics()
    {
        return $this->hasMany(Logic::class, ['option_id' => 'id']);
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\QuestionQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'question_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\QuestionOptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\QuestionOptionQuery(get_called_class());
    }
}
