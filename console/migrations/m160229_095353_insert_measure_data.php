<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_095353_insert_measure_data extends Migration
{
    public function up()
    {
    	$this->insert('measure', [
    			'id' => 1,
    			'name' => 'гр.',
    			'full_name' => 'граммы',
    		]);
    	$this->insert('measure', [
    			'id' => 2,
    			'name' => 'шт.',
    			'full_name' => 'штуки',
    		]);
    	$this->insert('measure', [
    			'id' => 3,
    			'name' => 'мл.',
    			'full_name' => 'милилитры',
    		]);
    	$this->insert('measure', [
    			'id' => 4,
    			'name' => 'л.',
    			'full_name' => 'литры',
    		]);
    	$this->insert('measure', [
    			'id' => 5,
    			'name' => 'кг.',
    			'full_name' => 'килограммы',
    		]);
    }

    public function down()
    {
        $this->delete('measure');
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
