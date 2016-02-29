<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_093709_create_dish_type_data extends Migration
{
    public function up()
    {
    	$this->insert('dish_type', [
    			'id' => 1,
    			'name' => 'Салаты',
    			'full_name' => 'Салаты',
    	]);
    	$this->insert('dish_type', [
    			'id' => 2,
    			'name' => 'Закуски',
    			'full_name' => 'Закуски',
    	]);
    	$this->insert('dish_type', [
    			'id' => 3,
    			'name' => 'Первое',
    			'full_name' => 'первые блюда',
    	]);
    	$this->insert('dish_type', [
    			'id' => 4,
    			'name' => 'Основное',
    			'full_name' => 'Основные блюда',
    	]);
    	$this->insert('dish_type', [
    			'id' => 5,
    			'name' => 'Паста',
    			'full_name' => 'Паста',
    	]);
    	$this->insert('dish_type', [
    			'id' => 6,
    			'name' => 'Напитки',
    			'full_name' => 'Напитки',
    	]);
    	$this->insert('dish_type', [
    			'id' => 7,
    			'name' => 'Гарниры',
    			'full_name' => 'Гарниры',
    	]);
    	$this->insert('dish_type', [
    			'id' => 8,
    			'name' => 'Десерты',
    			'full_name' => 'Десерты',
    	]);
    	$this->insert('dish_type', [
    			'id' => 9,
    			'name' => 'Фирмовые блюда',
    			'full_name' => 'Фирмовые блюда',
    	]);
    }

    public function down()
    {
    	$this->delete('dish_type');
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
