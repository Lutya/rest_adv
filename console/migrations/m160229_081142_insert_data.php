<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_081142_insert_data extends Migration
{
    public function safeUp()
    {
    	$this->insert('user', [
	    		'id' => 1,
		        'username' => 'admin',
		        'email' => 'admin@mail.ru',
		        'auth_key' => '3_mKFMVpQjOIGx1LRMQobjFAK0tu_nx7',
		        'password_hash' => '$2y$13$droAToZAxmRAb//0lha4N.XOe8Mh1fwjNdnKxN3t7tqiFxvpq8vDK',
	   			]);
		$this->insert('user', [
				'id' => 2,
		        'username' => 'manager',
		        'email' => 'manager@mail.ru',
		        'auth_key' => 'BUWoR572L3CXl3gkvJ-6_nmi5L1-M8dz',
		        'password_hash' => '$2y$13$yiaQWOniz9tUdYHQpmvrn.wVhhEFGLKZkMsJY2gfM9pBycaJEotXC',
		    	]);
		$this->insert('user', [
				'id' => 3,
				'username' => 'user',
				'email' => 'user@mail.ru',
				'auth_key' => 'hvzQYEtTl_8UN6lPKgF8ZT2WPvwETBVW',
				'password_hash' => '$2y$13$9jJHWNHjD.K/IFzTAJOJ2ON9hxDMCpJ.OyZ41od4LpaTmCabjQsjW',
		]);
		$this->insert('user', [
				'id' => 4,
				'username' => 'test3333',
				'email' => 'test@mailtest.ru',
				'auth_key' => 'n_5RcH7zBHdyPOHpFzYyku6GTUh4yQVO',
				'password_hash' => '$2y$13$4GQgpDShXhSPjfTSPgTEBuHd.nFzNJZKV18LV2GUrsQTsP5.aKcZi',
		]);
    }

    public function safeDown()
    {
        $this->delete('user');
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
