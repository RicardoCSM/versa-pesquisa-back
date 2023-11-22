<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logics}}`.
 */
class m231122_164904_create_logics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logics}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
            'target_question_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-logics-question_id}}',
            '{{%logics}}',
            'question_id'
        );

        $this->addForeignKey(
            '{{%fk-logics-question_id}}',
            '{{%logics}}',
            'question_id',
            '{{%questions}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-logics-option_id}}',
            '{{%logics}}',
            'option_id'
        );

        $this->addForeignKey(
            '{{%fk-logics-option_id}}',
            '{{%logics}}',
            'option_id',
            '{{%question_options}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-logics-target_question_id}}',
            '{{%logics}}',
            'target_question_id'
        );

        $this->addForeignKey(
            '{{%fk-logics-target_question_id}}',
            '{{%logics}}',
            'target_question_id',
            '{{%questions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-logics-target_question_id}',
            '{{%logics}}'
        );

        $this->dropIndex(
            '{{%idx-logics-target_question_id}',
            '{{%logics}}'
        );

        $this->dropForeignKey(
            '{{%fk-logics-option_id}}',
            '{{%logics}}'
        );

        $this->dropIndex(
            '{{%idx-logics-option_id}}',
            '{{%logics}}'
        );

        $this->dropForeignKey(
            '{{%fk-logics-question_id}}',
            '{{%logics}}'
        );

        $this->dropIndex(
            '{{%idx-logics-question_id}}',
            '{{%logics}}'
        );

        $this->dropTable('{{%logics}}');
    }
}
