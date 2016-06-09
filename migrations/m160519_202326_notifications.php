<?php

use yii\db\Migration;

class m160519_202326_notifications extends Migration
{
    public function up()
    {
        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'event_id' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'recipient_id' => $this->integer(),
            'subject' => $this->text(),
            'body' => $this->text(),
            'notification_type' => $this->string(),
            'viewed' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-notification-user_id',
            'notification',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-notification-user_id',
            'notification',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `recipient_id`
        $this->createIndex(
            'idx-notification-recipient_id',
            'notification',
            'recipient_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-notification-recipient_id',
            'notification',
            'recipient_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-notification-user_id',
            'notification'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-notification-user_id',
            'notification'
        );

        // drops foreign key for table `notification`
        $this->dropForeignKey(
            'fk-notification-recipient_id',
            'notification'
        );

        // drops index for column `recipient_id`
        $this->dropIndex(
            'idx-notification-recipient_id',
            'notification'
        );

        $this->dropTable('notification');
    }
}
