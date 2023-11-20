<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property int $id
 * @property int $response_id
 * @property int $question_id
 * @property string|null $content
 * @property float|null $score
 *
 * @property Question $question
 * @property Response $response
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%answers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_id', 'question_id'], 'required'],
            [['response_id', 'question_id'], 'integer'],
            [['content'], 'string'],
            [['score'], 'number'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::class, 'targetAttribute' => ['question_id' => 'id']],
            [['response_id'], 'exist', 'skipOnError' => true, 'targetClass' => Response::class, 'targetAttribute' => ['response_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'response_id' => Yii::t('app', 'Response ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'content' => Yii::t('app', 'Content'),
            'score' => Yii::t('app', 'Score'),
        ];
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
     * Gets query for [[Response]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ResponseQuery
     */
    public function getResponse()
    {
        return $this->hasOne(Response::class, ['id' => 'response_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\AnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AnswerQuery(get_called_class());
    }
}
