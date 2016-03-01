<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_062539_insert_data_dish extends Migration
{
    public function up()
    {
    	//салаты
    	$this->insert('dish', [
    			'id' => 1,
    			'name' => 'Цезарь',
    			'dish_type_id' => 1,
    			'count' => 300,
    			'measure_id' => 1,
    			'price' => 25,
    			'note' => 'Сыр, помидоры, огурцы, салат'	
    	]);
    	$this->insert('dish', [
    			'id' => 2,
    			'name' => 'Куриный',
    			'dish_type_id' => 1,
    			'count' => 250,
    			'measure_id' => 1,
    			'price' => 30,
    			'note' => 'Курица, болгарский перец, кукуруза, картофель'
    	]);
    	$this->insert('dish', [
    			'id' => 3,
    			'name' => 'Бунито',
    			'dish_type_id' => 1,
    			'count' => 250,
    			'measure_id' => 1,
    			'price' => 35,
    			'note' => 'Курица, корейская морковь, кукуруза, яицо'
    	]);
    	
    	//закуски
    	$this->insert('dish', [
    			'id' => 4,
    			'name' => 'Яйцо пашот',
    			'dish_type_id' => 2,
    			'count' => 100,
    			'measure_id' => 1,
    			'price' => 15,
    			//'note' => ''
    	]);
    	$this->insert('dish', [
    			'id' => 5,
    			'name' => 'Паштет',
    			'dish_type_id' => 2,
    			'count' => 200,
    			'measure_id' => 1,
    			'price' => 33,
    			//'note' => ''
    	]);
    	$this->insert('dish', [
    			'id' => 6,
    			'name' => 'Крабовые палочки в кляре',
    			'dish_type_id' => 2,
    			'count' => 220,
    			'measure_id' => 1,
    			'price' => 39,
    			//'note' => ''
    	]);
    	
    	//первой
    	$this->insert('dish', [
    			'id' => 7,
    			'name' => 'Борщ украинский',
    			'dish_type_id' => 3,
    			'count' => 300,
    			'measure_id' => 1,
    			'price' => 27,
    			'note' => 'Красный борщ со сметаной и пампушками'
    	]);
    	$this->insert('dish', [
    			'id' => 8,
    			'name' => 'Суп с фрикадельками',
    			'dish_type_id' => 3,
    			'count' => 250,
    			'measure_id' => 1,
    			'price' => 29,
    			'note' => 'Суп с фрикадельками и зеленью'
    	]);
    	$this->insert('dish', [
    			'id' => 9,
    			'name' => 'Бульйон куриный',
    			'dish_type_id' => 3,
    			'count' => 260,
    			'measure_id' => 3,
    			'price' => 20,
    			'note' => 'Горячий бульйон на свежей курочке =)'
    	]);
    }

    public function down()
    {
        $this->delete('dish');
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
