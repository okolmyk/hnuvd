<?php

use yii\db\Migration;

/**
 * Class m180525_104723_users
 */
class m180525_104723_users extends Migration
{

    public function safeUp()
    {
      $this->createTable('{{%users}}', [
        'id' => $this->primaryKey(),
        'email' => $this->string()->notNull(),
        'password' => $this->string()->notNull(),
        'adminGroup' => "ENUM('admin', 'monitor', 'manager')",
      ]);
    }


    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }

}
