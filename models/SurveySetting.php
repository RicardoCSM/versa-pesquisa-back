<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%survey_settings}}".
 *
 * @property int $id
 * @property int|null $create_test
 * @property int|null $collect_email_addresses
 * @property int|null $send_participants_copy_of_responses
 * @property int|null $make_questions_mandatory_by_default
 * @property int|null $limit_to_1_answer
 * @property int|null $show_link_to_send_another_answer
 *
 * @property Survey[] $surveys
 */
class SurveySetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%survey_settings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_test', 'collect_email_addresses', 'send_participants_copy_of_responses', 'make_questions_mandatory_by_default', 'limit_to_1_answer', 'show_link_to_send_another_answer'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'create_test' => Yii::t('app', 'Create Test'),
            'collect_email_addresses' => Yii::t('app', 'Collect Email Addresses'),
            'send_participants_copy_of_responses' => Yii::t('app', 'Send Participants Copy Of Responses'),
            'make_questions_mandatory_by_default' => Yii::t('app', 'Make Questions Mandatory By Default'),
            'limit_to_1_answer' => Yii::t('app', 'Limit To 1 Answer'),
            'show_link_to_send_another_answer' => Yii::t('app', 'Show Link To Send Another Answer'),
        ];
    }

    /**
     * Gets query for [[Surveys]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SurveyQuery
     */
    public function getSurveys()
    {
        return $this->hasMany(Survey::class, ['setting_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\SurveySettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SurveySettingQuery(get_called_class());
    }
}
