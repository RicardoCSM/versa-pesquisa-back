<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%survey_settings}}`.
 */
class m231121_115138_create_survey_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%survey_settings}}', [
            'id' => $this->primaryKey(),
            'create_test' => $this->boolean()->defaultValue(false),
            'collect_email_addresses' => $this->boolean()->defaultValue(false),
            'send_participants_copy_of_responses' => $this->boolean()->defaultValue(false),
            'make_questions_mandatory_by_default' => $this->boolean()->defaultValue(false),
            'limit_to_1_answer' => $this->boolean()->defaultValue(false),
            'show_link_to_send_another_answer' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%survey_settings}}');
    }
}
