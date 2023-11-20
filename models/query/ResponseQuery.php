<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Response]].
 *
 * @see \app\models\Response
 */
class ResponseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Response[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Response|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
