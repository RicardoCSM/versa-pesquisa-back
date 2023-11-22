<?php

use yii\db\Migration;

/**
 * Class m231121_115735_add_setting_field_to_surveys
 */
class m231121_115735_add_setting_field_to_surveys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('surveys', 'setting_id', $this->integer());

        $this->createIndex(
            '{{%idx-surveys-setting_id}}',
            '{{%surveys}}',
            'setting_id'
        );

        $this->addForeignKey(
            '{{%fk-surveys-setting_id}}',
            '{{%surveys}}',
            'setting_id',
            '{{%survey_settings}}',
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
            '{{%fk-surveys-setting_id}}',
            '{{%surveys}}'
        );

        $this->dropIndex(
            '{{%idx-surveys-setting_id}}',
            '{{%surveys}}'
        );

        $this->dropColumn('surveys', 'setting_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231121_115735_add_setting_field_to_surveys cannot be reverted.\n";

        return false;
    }
    */
}
