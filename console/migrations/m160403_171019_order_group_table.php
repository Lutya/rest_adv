<?php

use yii\db\Migration;
use yii\db\Schema;

class m160403_171019_order_group_table extends Migration
{
    public function up()
    {
    	$this->createTable('order_group', [
    			'id' => Schema::TYPE_STRING . '(15) NOT NULL',
    			'group_id' => Schema::TYPE_INTEGER,
    			'order_status' => Schema::TYPE_BOOLEAN, //0-еще в обработке, 1 - подтвержден
    			'date' => Schema::TYPE_DATE,
    			'number' => Schema::TYPE_STRING,
    	]);
    	
    	$this->addForeignKey(
    			'fk_orders_group_group_id', 'order_group',
    			'group_id', 'user_group', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addPrimaryKey(
    			'pk_order_group_id', 'order_group', 'id'
    			);
    }

    public function down()
    {
        $this->dropTable('order_group');
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
