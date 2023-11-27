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
            'name' => $this->string(255)->defaultValue("Default"),
            'description' => $this->string(255)->defaultValue("Default theme"),
            'primary_color' => $this->string(255)->defaultValue("#1565C0"),
            'secondary_color' => $this->string(255)->defaultValue("#1f2937"),
            'background_color' => $this->string(255)->defaultValue("#F8F2E2"),
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
