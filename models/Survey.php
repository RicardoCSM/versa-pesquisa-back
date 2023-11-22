<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%surveys}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $theme_id
 * @property string $title
 * @property string|null $description
 * @property string $category
 * @property string $type
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $setting_id
 *
 * @property Page[] $pages
 * @property Question[] $questions
 * @property Response[] $responses
 * @property SurveySetting $setting
 * @property Theme $theme
 * @property User $user
 */
class Survey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%surveys}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'category', 'type', 'status'], 'required'],
            [['user_id', 'theme_id', 'status', 'created_at', 'updated_at', 'setting_id'], 'integer'],
            [['title', 'description', 'category', 'type'], 'string', 'max' => 255],
            [['setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => SurveySetting::class, 'targetAttribute' => ['setting_id' => 'id']],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::class, 'targetAttribute' => ['theme_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'theme_id' => Yii::t('app', 'Theme ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'setting_id' => Yii::t('app', 'Setting ID'),
        ];
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\PageQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::class, ['survey_id' => 'id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\QuestionQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['survey_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ResponseQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['survey_id' => 'id']);
    }

    /**
     * Gets query for [[Setting]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SurveySettingQuery
     */
    public function getSetting()
    {
        return $this->hasOne(SurveySetting::class, ['id' => 'setting_id']);
    }

    /**
     * Gets query for [[Theme]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ThemeQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Theme::class, ['id' => 'theme_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\SurveyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SurveyQuery(get_called_class());
    }
}
