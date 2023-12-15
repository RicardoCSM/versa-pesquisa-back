<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property int $page_id
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property int $position
 * @property int|null $obrigatory
 * @property float|null $score
 *
 * @property Answer[] $answers
 * @property Logic[] $logics
 * @property Logic[] $logics0
 * @property Page $page
 * @property QuestionOption[] $questionOptions
 * @property Survey $survey
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'page_id'], 'required'],
            [['survey_id', 'page_id', 'position', 'obrigatory'], 'integer'],
            [['score'], 'number'],
            [['type', 'title', 'description'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
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
            'page_id' => Yii::t('app', 'Page ID'),
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'position' => Yii::t('app', 'Position'),
            'obrigatory' => Yii::t('app', 'Obrigatory'),
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
        return $this->hasMany(Answer::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Logics]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\LogicQuery
     */
    public function getLogics()
    {
        return $this->hasMany(Logic::class, ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Logics0]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\LogicQuery
     */
    public function getLogics0()
    {
        return $this->hasMany(Logic::class, ['target_question_id' => 'id']);
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\PageQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

    /**
     * Gets query for [[QuestionOptions]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\QuestionOptionQuery
     */
    public function getQuestionOptions()
    {
        return $this->hasMany(QuestionOption::class, ['question_id' => 'id']);
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
     * @return \app\models\query\QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\QuestionQuery(get_called_class());
    }
}
