<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%responses}}`.
 */
class m231120_173436_create_responses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%responses}}', [
            'id' => $this->primaryKey(),
            'survey_id' => $this->integer()->notNull(),
            'started_at' => $this->datetime(),
            'ended_at' => $this->datetime(),
            'score' => $this->float(),
        ]);

        $this->createIndex(
            '{{%idx-responses-survey_id}}',
            '{{%responses}}',
            'survey_id'
        );

        $this->addForeignKey(
            '{{%fk-responses-survey_id}}',
            '{{%responses}}',
            'survey_id',
            '{{%surveys}}',
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
            '{{%fk-responses-survey_id}}',
            '{{%responses}}'
        );
        
        $this->dropIndex(
            '{{%idx-responses-survey_id}}',
            '{{%responses}}'
        );

        $this->dropTable('{{%responses}}');
    }
}
