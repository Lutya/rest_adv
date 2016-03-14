<?php

use yii\db\Schema;
use yii\db\Migration;

class m160311_095043_add_column_image_to_table_dish extends Migration
{
    public function up()
    {
    	$this->addColumn('dish', 'photo', 'string');
    	//$this->addColumn('dish', 'del_img', 'boolean');
    }

    public function down()
    {
        $this->dropColumn('dish', 'photo');
        //$this->dropColumn('dish','del_img');
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
