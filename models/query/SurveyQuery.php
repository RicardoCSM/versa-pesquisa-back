<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Survey]].
 *
 * @see \app\models\Survey
 */
class SurveyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Survey[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Survey|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Survey[]|array
     */
    public function byUser($id)
    {
        return $this->andWhere(['user_id' => $id]);
    }
}
