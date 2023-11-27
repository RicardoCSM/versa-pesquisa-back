<?php

use yii\db\Migration;

/**
 * Class m231127_190249_add_images_to_themes
 */
class m231127_190249_add_images_to_themes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('themes', 'background_image_id', $this->integer(11));
        $this->addColumn('themes', 'logo_image_id', $this->integer(11));

        $this->createIndex(
            '{{%idx-themes-background_image_id}}',
            '{{%themes}}',
            'background_image_id'
        );

        $this->addForeignKey(
            '{{%fk-themes-background_image_id}}',
            '{{%themes}}',
            'background_image_id',
            '{{%images}}',
            'id',
            'SET NULL'
        );

        $this->createIndex(
            '{{%idx-themes-logo_image_id}}',
            '{{%themes}}',
            'logo_image_id'
        );

        $this->addForeignKey(
            '{{%fk-themes-logo_image_id}}',
            '{{%themes}}',
            'logo_image_id',
            '{{%images}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-themes-logo_image_id}}',
            '{{%themes}}'
        );

        $this->dropIndex(
            '{{%idx-themes-logo_image_id}}',
            '{{%themes}}'
        );

        $this->dropForeignKey(
            '{{%fk-themes-background_image_id}}',
            '{{%themes}}'
        );

        $this->dropIndex(
            '{{%idx-themes-background_image_id}}',
            '{{%themes}}'
        );

        $this->dropColumn('themes', 'logo_image_id');
        $this->dropColumn('themes', 'background_image_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231127_190249_add_images_to_themes cannot be reverted.\n";

        return false;
    }
    */
}
