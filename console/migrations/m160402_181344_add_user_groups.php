<?php

use yii\db\Migration;
use yii\db\Schema;

class m160402_181344_add_user_groups extends Migration
{
    public function up()
    {
    	$this->createTable('user_group', [
    			'id' => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . ' NOT NULL',
    			'date' => Schema::TYPE_DATE,
    			'owner_id' => Schema::TYPE_INTEGER,	
    	]);
    	
    	$this->addForeignKey(
    			'fk_user_group_owner_id', 'user_group',
    			'owner_id', 'user', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropTable('user_group');
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
