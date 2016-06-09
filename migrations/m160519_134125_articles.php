<?php

use yii\db\Migration;

class m160519_134125_articles extends Migration
{
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'alias' => $this->string(255)->comment('Link for article'),
        ]);
    }

    public function down()
    {
        $this->dropTable('article');
    }
}
