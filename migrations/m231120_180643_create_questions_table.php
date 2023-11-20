<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m231120_180643_create_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'survey_id' => $this->integer()->notNull(),
            'page_id' => $this->integer()->notNull(),
            'type' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'position' => $this->integer()->notNull(),
            'obrigatory' => $this->tinyInteger(),
            'score' => $this->float(),
        ]);

        $this->createIndex(
            '{{%idx-questions-survey_id}}',
            '{{%questions}}',
            'survey_id'
        );

        $this->addForeignKey(
            '{{%fk-questions-survey_id}}',
            '{{%questions}}',
            'survey_id',
            '{{%surveys}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-questions-page_id}}',
            '{{%questions}}',
            'page_id'
        );

        $this->addForeignKey(
            '{{%fk-questions-page_id}}',
            '{{%questions}}',
            'page_id',
            '{{%pages}}',
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
            '{{%fk-questions-page_id}}',
            '{{%questions}}'
        );
        
        $this->dropIndex(
            '{{%idx-questions-page_id}}',
            '{{%questions}}'
        );

        $this->dropForeignKey(
            '{{%fk-questions-survey_id}}',
            '{{%questions}}'
        );
        
        $this->dropIndex(
            '{{%idx-questions-survey_id}}',
            '{{%questions}}'
        );

        $this->dropTable('{{%questions}}');
    }
}
