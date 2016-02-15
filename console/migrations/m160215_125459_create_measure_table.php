<?php

use yii\db\Schema;
use yii\db\Migration;

class m160215_125459_create_measure_table extends Migration
{
    public function up()
    {
    	$this->createTable('measure', [
    			'id' => Schema::TYPE_PK,
    			'name' => Schema::TYPE_STRING . ' NOT NULL',
    			'full_name' => Schema::TYPE_TEXT . ' NOT NULL',
    	]);
    }

    public function down()
    {
        $this->dropTable('measure');
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
