<?php

use yii\db\Schema;
use yii\db\Migration;

class m160302_084542_create_basket extends Migration
{
    public function up()
    {
    	$this->createTable('basket', [
    			'id' => Schema::TYPE_PK,
    			'dish_id' => Schema::TYPE_INTEGER,
    			'count' => Schema::TYPE_INTEGER . ' NOT NULL',
    			'date' => Schema::TYPE_DATE . ' NOT NULL',
    	]);
    	
    	$this->addForeignKey(
    			'fk_basket_dish_id', 'basket',
    			'dish_id', 'dish', 'id', 'SET NULL', 'CASCADE'
    			);
    }

    public function down()
    {
        $this->dropTable('basket');
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
