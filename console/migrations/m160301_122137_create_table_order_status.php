<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_122137_create_table_order_status extends Migration
{
    public function up()
    {
    	$this->createTable('order_status', [
    			'id' => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . ' NOT NULL',
    	]);
    	
    	$this->insert('order_status', [
    			'id' => 1,
    			'name' => 'Открытый',
    	]);
    	$this->insert('order_status', [
    			'id' => 2,
    			'name' => 'В обработке',
    	]);
    	$this->insert('order_status', [
    			'id' => 3,
    			'name' => 'Закрытый',
    	]);
    }

    public function down()
    {
    	$this->delete('order_status');
       	$this->dropTable('order_status');
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
