<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%themes}}`.
 */
class m231117_182048_create_themes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%themes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->string(255),
            'primary_color' => $this->string(255),
            'secondary_color' => $this->string(255),
            'background_color' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%themes}}');
    }
}
