<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%logics}}".
 *
 * @property int $id
 * @property int $question_id
 * @property int $option_id
 * @property int $target_question_id
 *
 * @property QuestionOption $option
 * @property Question $question
 * @property Question $targetQuestion
 */
class Logic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%logics}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'option_id', 'target_question_id'], 'required'],
            [['question_id', 'option_id', 'target_question_id'], 'integer'],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionOption::class, 'targetAttribute' => ['option_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['question_id' => 'id']],
            [['target_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['target_question_id' => 'id']],
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
            'option_id' => Yii::t('app', 'Option ID'),
            'target_question_id' => Yii::t('app', 'Target Question ID'),
        ];
    }

    /**
     * Gets query for [[Option]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\QuestionOptionQuery
     */
    public function getOption()
    {
        return $this->hasOne(QuestionOption::class, ['id' => 'option_id']);
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
     * Gets query for [[TargetQuestion]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\QuestionQuery
     */
    public function getTargetQuestion()
    {
        return $this->hasOne(Question::class, ['id' => 'target_question_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\LogicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LogicQuery(get_called_class());
    }
}
