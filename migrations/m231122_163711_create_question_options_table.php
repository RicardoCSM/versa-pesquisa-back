<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question_options}}`.
 */
class m231122_163711_create_question_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question_options}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'option_text' => $this->string(255)->notNull(),
            'position' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-question_options-question_id}}',
            '{{%question_options}}',
            'question_id'
        );

        $this->addForeignKey(
            '{{%fk-question_options-question_id}}',
            '{{%question_options}}',
            'question_id',
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
            '{{%fk-question_options-question_id}}',
            '{{%question_options}}'
        );

        $this->dropIndex(
            '{{%idx-question_options-question_id}}',
            '{{%question_options}}'
        );

        $this->dropTable('{{%question_options}}');
    }
}
