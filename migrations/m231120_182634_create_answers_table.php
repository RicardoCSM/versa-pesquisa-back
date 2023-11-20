<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m231120_182634_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'response_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'content' => $this->text(),
            'score' => $this->float(),
        ]);

        $this->createIndex(
            '{{%idx-answers-response_id}}',
            '{{%answers}}',
            'response_id'
        );

        $this->addForeignKey(
            '{{%fk-answers-response_id}}',
            '{{%answers}}',
            'response_id',
            '{{%responses}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-answers-question_id}}',
            '{{%answers}}',
            'question_id'
        );

        $this->addForeignKey(
            '{{%fk-answers-question_id}}',
            '{{%answers}}',
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
            '{{%fk-answers-question_id}}',
            '{{%answers}}'
        );
        
        $this->dropIndex(
            '{{%idx-answers-question_id}}',
            '{{%answers}}'
        );

        $this->dropForeignKey(
            '{{%fk-answers-response_id}}',
            '{{%answers}}'
        );
        
        $this->dropIndex(
            '{{%idx-answers-response_id}}',
            '{{%answers}}'
        );

        $this->dropTable('{{%answers}}');
    }
}
