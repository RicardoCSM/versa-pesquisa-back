<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Logic]].
 *
 * @see \app\models\Logic
 */
class LogicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Logic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Logic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
