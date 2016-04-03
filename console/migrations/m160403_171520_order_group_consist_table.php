<?php

use yii\db\Migration;
use yii\db\Schema;

class m160403_171520_order_group_consist_table extends Migration
{
    public function up()
    {
    	$this->createTable('order_group_consist', [
    			'id' => Schema::TYPE_PK,
    			'order_group_id' => Schema::TYPE_STRING,
    			'dish_id' => Schema::TYPE_INTEGER,
    			'count' => Schema::TYPE_INTEGER . ' NOT NULL',
    			'user_id' => Schema::TYPE_INTEGER,
    	]);
    	
    	$this->addForeignKey(
    			'fk_order_group_consists_order_group_id', 'order_group_consist',
    			'order_group_id', 'order_group', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_order_group_consists_user_id', 'order_group_consist',
    			'user_id', 'user', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_order_group_consists_dish_id', 'order_group_consist',
    			'dish_id', 'dish', 'id', 'SET NULL', 'CASCADE'
    			);

    }

    public function down()
    {
        $this->dropTable('order_group_consist');
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
