<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Question]].
 *
 * @see \app\models\Question
 */
class QuestionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Question[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Question|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Question[]|array
     */
    public function fromSurveyAndPage($survey_id, $page_id)
    {
        return $this->andWhere(['survey_id' => $survey_id, 'page_id' => $page_id]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Question|array|null
     */
    public function withSurveyAndPage($id, $survey_id, $page_id)
    {
        return $this->andWhere(['id' => $id, 'survey_id' => $survey_id, 'page_id' => $page_id])->one();
    }
}
