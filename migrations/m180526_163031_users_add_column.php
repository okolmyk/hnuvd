<?php

use yii\db\Migration;

/**
 * Class m180526_163031_users_add_column
 */
class m180526_163031_users_add_column extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'auth_key', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'auth_key');
    }

}
