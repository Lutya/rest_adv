<?php

use yii\db\Migration;
use yii\db\Schema;

class m160402_184745_create_entry_table extends Migration
{
    public function up()
    {
        $this->createTable('entry', [
    			'user_id' => Schema::TYPE_INTEGER,
    			'group_id' => Schema::TYPE_INTEGER,
    			'date' => Schema::TYPE_DATE,
        		'status_user' => Schema::TYPE_BOOLEAN, //0-подана заявка, 1- принята заявка
    	]);
        
        $this->addForeignKey(
        		'fk_entry_user_id', 'entry',
        		'user_id', 'user', 'id', 'SET NULL', 'CASCADE'
        		);
        
        $this->addForeignKey(
        		'fk_entry_group_id', 'entry',
        		'group_id', 'user_group', 'id', 'SET NULL', 'CASCADE'
        		);
    }

    public function down()
    {
        $this->dropTable('entry');
    }
}
