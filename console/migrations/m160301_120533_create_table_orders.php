<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_120533_create_table_orders extends Migration
{
    public function up()
    {
    	$this->createTable('orders', [
    			'id' => Schema::TYPE_PK,
    			'dish_id' => Schema::TYPE_INTEGER,
    			'user_id' => Schema::TYPE_INTEGER,
    			'count' => Schema::TYPE_INTEGER . ' NOT NULL',
    			'price' => Schema::TYPE_DECIMAL . '(5,2) NOT NULL',
    			'sum' => Schema::TYPE_DECIMAL . '(5,2) NOT NULL',
    			'order_status_id' => Schema::TYPE_INTEGER,
    	]);
    	
    	$this->addForeignKey(
    			'fk_orders_dish_id', 'orders',
    			'dish_id', 'dish', 'id', 'SET NULL', 'CASCADE'
    			);
    	 
    	$this->addForeignKey(
    			'fk_orders_user_id', 'orders',
    			'user_id', 'user', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_orders_order_status_id', 'orders',
    			'order_status_id', 'order_status', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropTable('orders');
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
