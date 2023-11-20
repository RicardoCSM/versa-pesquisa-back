<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m231120_175238_create_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'survey_id' => $this->integer()->notNull(),
            'title' => $this->string(255),
            'description' => $this->string(255),
            'position' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-pages-survey_id}}',
            '{{%pages}}',
            'survey_id'
        );

        $this->addForeignKey(
            '{{%fk-pages-survey_id}}',
            '{{%pages}}',
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
            '{{%fk-pages-survey_id}}',
            '{{%pages}}'
        );
        
        $this->dropIndex(
            '{{%idx-pages-survey_id}}',
            '{{%pages}}'
        );

        $this->dropTable('{{%pages}}');
    }
}
