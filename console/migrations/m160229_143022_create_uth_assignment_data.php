<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_143022_create_uth_assignment_data extends Migration
{
    public function up()
    {
    	$this->insert('auth_assignment', [
    			'item_name' => 'admin',
    			'user_id' => 1,
    	]);
    	$this->insert('auth_assignment', [
    			'item_name' => 'manager',
    			'user_id' => 2,
    	]);
    	$this->insert('auth_assignment', [
    			'item_name' => 'user',
    			'user_id' => 3,
    	]);

    }

    public function down()
    {
        $this->delete('auth_assignment');
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
