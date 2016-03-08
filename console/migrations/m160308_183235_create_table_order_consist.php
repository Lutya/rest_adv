<?php

use yii\db\Schema;
use yii\db\Migration;

class m160308_183235_create_table_order_consist extends Migration
{
    public function up()
    {
    	$this->createTable('order_consist', [
    			'id' => Schema::TYPE_PK,
    			'order_id' => Schema::TYPE_STRING,
    			'dish_id' => Schema::TYPE_INTEGER,
    			'count' => Schema::TYPE_INTEGER . ' NOT NULL',
    	]);
    	
    	$this->addForeignKey(
    			'fk_order_consists_order_id', 'order_consist',
    			'order_id', 'orders', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_order_consists_dish_id', 'order_consist',
    			'dish_id', 'dish', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropTable('order_consist');
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
