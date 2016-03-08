<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_120533_create_table_orders extends Migration
{
    public function up()
    {
    	$this->createTable('orders', [
    			'id' => Schema::TYPE_STRING . '(15) NOT NULL',
    			//'dish_id' => Schema::TYPE_INTEGER,
    			'user_id' => Schema::TYPE_INTEGER,
    			'order_status_id' => Schema::TYPE_INTEGER,
    			'date' => Schema::TYPE_DATE,
    			'number' => Schema::TYPE_STRING,
    			'delivery' => schema::TYPE_BOOLEAN,
    	]);
    	
    	/*$this->addForeignKey(
    			'fk_orders_dish_id', 'orders',
    			'dish_id', 'dish', 'id', 'SET NULL', 'CASCADE'
    			);*/
    	 
    	$this->addForeignKey(
    			'fk_orders_user_id', 'orders',
    			'user_id', 'user', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_orders_order_status_id', 'orders',
    			'order_status_id', 'order_status', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addPrimaryKey(
    			'pk_order_id', 'orders', 'id'
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
