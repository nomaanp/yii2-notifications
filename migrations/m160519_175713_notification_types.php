<?php

use yii\db\Migration;

class m160519_175713_notification_types extends Migration
{
    public function up()
    {
        $this->createTable('notification_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'class' => $this->string()->notNull()->comment('Name of class with namespace'),
        ]);
    }

    public function down()
    {
        $this->dropTable('notification_type');
    }
}
