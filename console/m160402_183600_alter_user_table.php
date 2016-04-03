<?php

use yii\db\Migration;

class m160402_183600_alter_user_table extends Migration
{
    public function up()
    {
    	$this->addColumn('user', 'group_id', 'integer');
    	$this->addColumn('user', 'owner_group', 'boolean');
		
    	$this->addForeignKey(
    			'fk_user_group_id', 'user',
    			'group_id', 'user_group', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_group_id', 'user');
        $this->dropColumn('user', 'owner_group');
        $this->dropColumn('user', 'group_id');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
