<?php

use yii\db\Schema;
use yii\db\Migration;

class m160215_131618_create_dish_type_table extends Migration
{
    public function up()
    {
    	$this->createTable('dish_type', [
    			'id' => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . ' NOT NULL',
    			'full_name' => Schema::TYPE_TEXT . ' NOT NULL',
    	]);
    }

    public function down()
    {
        $this->dropTable('dish_type');
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
