<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Page]].
 *
 * @see \app\models\Page
 */
class PageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Page[]|array
     */
    public function fromSurvey($survey_id)
    {
        return $this->andWhere(['survey_id' => $survey_id]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Page|array|null
     */
    public function withSurvey($id, $survey_id)
    {
        return $this->andWhere(['id' => $id, 'survey_id' => $survey_id])->one();
    }
}
