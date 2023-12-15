<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%surveys}}`.
 */
class m231117_194123_create_surveys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%surveys}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'theme_id' => $this->integer(),
            'title' => $this->string(255)->defaultValue("My Survey"),
            'description' => $this->string(255),
            'category' => $this->string(255)->defaultValue("survey"),
            'type' => $this->string(255)->defaultValue("1"),
            'status' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11)
        ]);

        $this->createIndex(
            '{{%idx-surveys-user_id}}',
            '{{%surveys}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-surveys-user_id}}',
            '{{%surveys}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-surveys-theme_id}}',
            '{{%surveys}}',
            'theme_id'
        );

        $this->addForeignKey(
            '{{%fk-surveys-theme_id}}',
            '{{%surveys}}',
            'theme_id',
            '{{%themes}}',
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
            '{{%fk-surveys-theme_id}}',
            '{{%surveys}}'
            );
    
        $this->dropIndex(
            '{{%idx-surveys-theme_id}}',
            '{{%surveys}}'
        );

        $this->dropForeignKey(
            '{{%fk-surveys-user_id}}',
            '{{%surveys}}'
        );
        
        $this->dropIndex(
            '{{%idx-surveys-user_id}}',
            '{{%surveys}}'
        );

        $this->dropTable('{{%surveys}}');
    }
}
