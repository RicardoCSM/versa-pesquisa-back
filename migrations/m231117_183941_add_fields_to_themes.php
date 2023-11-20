<?php

use yii\db\Migration;

/**
 * Class m231117_183941_add_fields_to_themes
 */
class m231117_183941_add_fields_to_themes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('themes', 'created_at', $this->integer(11));
        $this->addColumn('themes', 'created_by', $this->integer(11));
        $this->addColumn('themes', 'updated_at', $this->integer(11));

        $this->createIndex(
            '{{%idx-themes-created_by}}',
            '{{%themes}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-themes-created_by}}',
            '{{%themes}}',
            'created_by',
            '{{%users}}',
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
        '{{%fk-themes-created_by}}',
        '{{%themes}}'
        );

        $this->dropIndex(
            '{{%idx-themes-created_by}}',
            '{{%themes}}'
        );

        $this->dropColumn('themes', 'created_at');
        $this->dropColumn('themes', 'created_by');
        $this->dropColumn('themes', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231117_183941_add_fields_to_themes cannot be reverted.\n";

        return false;
    }
    */
}
