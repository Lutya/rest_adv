<?php

use yii\db\Schema;
use yii\db\Migration;

class m160314_094738_update_data_photo_in_dish_table extends Migration
{
    public function up()
    {
		$this->update('dish',['photo' => 'uploads/cezar.jpg'], 'id = 1');
		$this->update('dish',['photo' => 'uploads/kuriniy.jpg'], 'id = 2');
		$this->update('dish',['photo' => 'uploads/bunito.jpg'], 'id = 3');
		$this->update('dish',['photo' => 'uploads/yajco pashot.jpg'], 'id = 4');
		$this->update('dish',['photo' => 'uploads/pashtet.jpg'], 'id = 5');
		$this->update('dish',['photo' => 'uploads/crabs.jpg'], 'id = 6');
		$this->update('dish',['photo' => 'uploads/borsch_ukr.jpg'], 'id = 7');
		$this->update('dish',['photo' => 'uploads/sup_s_frikadel_kami.jpeg'], 'id = 8');
		$this->update('dish',['photo' => 'uploads/bulion_kurinuy.jpg'], 'id = 9');
    }

    public function down()
    {
    	$this->update('dish',['photo' => NULL], 'id = 1');
    	$this->update('dish',['photo' => NULL], 'id = 2');
    	$this->update('dish',['photo' => NULL], 'id = 3');
    	$this->update('dish',['photo' => NULL], 'id = 4');
    	$this->update('dish',['photo' => NULL], 'id = 5');
    	$this->update('dish',['photo' => NULL], 'id = 6');
    	$this->update('dish',['photo' => NULL], 'id = 7');
    	$this->update('dish',['photo' => NULL], 'id = 8');
    	$this->update('dish',['photo' => NULL], 'id = 9');
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
