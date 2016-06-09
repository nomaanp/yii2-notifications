<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notification_notification_type`.
 * Has foreign keys to the tables:
 *
 * - `notification`
 * - `notification_type`
 */
class m160605_160728_create_junction_notification_and_notification_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notification_notification_type', [
            'notification_id' => $this->integer(),
            'notification_type_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'PRIMARY KEY(notification_id, notification_type_id)',
        ]);

        // creates index for column `notification_id`
        $this->createIndex(
            'idx-notification_notification_type-notification_id',
            'notification_notification_type',
            'notification_id'
        );

        // add foreign key for table `notification`
        $this->addForeignKey(
            'fk-notification_notification_type-notification_id',
            'notification_notification_type',
            'notification_id',
            'notification',
            'id',
            'CASCADE'
        );

        // creates index for column `notification_type_id`
        $this->createIndex(
            'idx-notification_notification_type-notification_type_id',
            'notification_notification_type',
            'notification_type_id'
        );

        // add foreign key for table `notification_type`
        $this->addForeignKey(
            'fk-notification_notification_type-notification_type_id',
            'notification_notification_type',
            'notification_type_id',
            'notification_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `notification`
        $this->dropForeignKey(
            'fk-notification_notification_type-notification_id',
            'notification_notification_type'
        );

        // drops index for column `notification_id`
        $this->dropIndex(
            'idx-notification_notification_type-notification_id',
            'notification_notification_type'
        );

        // drops foreign key for table `notification_type`
        $this->dropForeignKey(
            'fk-notification_notification_type-notification_type_id',
            'notification_notification_type'
        );

        // drops index for column `notification_type_id`
        $this->dropIndex(
            'idx-notification_notification_type-notification_type_id',
            'notification_notification_type'
        );

        $this->dropTable('notification_notification_type');
    }
}
