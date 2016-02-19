<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_085941_create_roles extends Migration
{
    public function up() //safeUp()
    {
    	$rbac = \Yii::$app->authManager;
    	
    	$guest = $rbac->createRole('guest');
    	$guest->description = 'Nobody';
    	$rbac->add($guest);
    	
    	$user = $rbac->createRole('user');
    	$user->description = 'Can use the query and nothing else';
    	$rbac->add($user);
    	
    	$manager = $rbac->createRole('manager');
    	$manager->description = 'Can manage entities in db, but not users';
    	$rbac->add($manager);
		
    	$admin = $rbac->createRole('admin');
    	$admin->description = 'Can do anything including namaging users';
    	$rbac->add($admin);
    	
    	$rbac->addChild($admin, $manager);
    	$rbac->addChild($manager, $user);
    	$rbac->addChild($user, $guest);
    	
    	$rbac->assign($user, \backend\models\user\User::findOne(['username' => 'user'])->id);
    	$rbac->assign($manager, \backend\models\user\User::findOne(['username' => 'manager'])->id);
    	$rbac->assign($admin, \backend\models\user\User::findOne(['username' => 'admin'])->id);
    }

    public function down() //safeDown()
    {
        $manager = \Yii::$app->authManager;
		$manager->removeAll();
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
