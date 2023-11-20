<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%responses}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property string|null $started_at
 * @property string|null $ended_at
 * @property float|null $score
 *
 * @property Answer[] $answers
 * @property Survey $survey
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%responses}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'started_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()')
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id'], 'required'],
            [['survey_id'], 'integer'],
            [['started_at', 'ended_at'], 'safe'],
            [['score'], 'number'],
            [['survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Survey::class, 'targetAttribute' => ['survey_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'survey_id' => Yii::t('app', 'Survey ID'),
            'started_at' => Yii::t('app', 'Started At'),
            'ended_at' => Yii::t('app', 'Ended At'),
            'score' => Yii::t('app', 'Score'),
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\AnswerQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['response_id' => 'id']);
    }

    /**
     * Gets query for [[Survey]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SurveyQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::class, ['id' => 'survey_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ResponseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ResponseQuery(get_called_class());
    }
}
