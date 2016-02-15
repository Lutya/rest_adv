<?php

use yii\db\Schema;
use yii\db\Migration;

class m160215_134218_create_dish_table extends Migration
{
    public function up()
    {
    	$this->createTable('dish', [
    			'id' => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . ' NOT NULL',
    			'dish_type_id' => Schema::TYPE_INTEGER,
    			'count' => Schema::TYPE_FLOAT . ' NOT NULL',
    			'measure_id' => Schema::TYPE_INTEGER,
    			'price' => Schema::TYPE_DECIMAL . '(5,2) NOT NULL',
    			'note' => Schema::TYPE_TEXT,
    	]);
    	
    	$this->addForeignKey(
    			'fk_dish_dish_type_id', 'dish',
    			'dish_type_id', 'dish_type', 'id', 'SET NULL', 'CASCADE'
    			);
    	
    	$this->addForeignKey(
    			'fk_dish_measure_id', 'dish',
    			'measure_id', 'measure', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropTable('dish');
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
