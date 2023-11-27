<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\QuestionOption]].
 *
 * @see \app\models\QuestionOption
 */
class QuestionOptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\QuestionOption[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\QuestionOption|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\QuestionOption[]|array
     */
    public function fromQuestion($question_id)
    {
        return $this->andWhere(['question_id' => $question_id]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\QuestionOption|array|null
     */
    public function withQuestion($id, $question_id)
    {
        return $this->andWhere(['id' => $id, 'question_id' => $question_id])->one();
    }
}
