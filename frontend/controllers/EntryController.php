<?php

namespace frontend\controllers;

use frontend\models\entry\Entry;
use Yii;

class EntryController extends \yii\web\Controller
{
    public function actionAdd($group_id)
    {
    	$user_id = Yii::$app->user->identity->id;
    	$session = Yii::$app->session;
    	
    	if (!isset($user_id)) {
    			$session->setFlash('addEntry', 'Нужно сначала авторизироваться');
    			return $this->redirect(Yii::$app->request->referrer);
    		}
    	//проверяем не состоит ли пользователь в этой группе
    	$in_group = Entry::find()
    		->where([
    			'user_id' => $user_id,
    			'group_id' => $group_id,
    		])
    		->count();
    	if ($in_group > 0) 
    		$session->setFlash('addEntry', 'Вы уже состоите в этой группе или уже подали заявку');
    	else {
    		$entry = new Entry();
    		$entry->user_id = $user_id;
    		$entry->group_id = $group_id;
    		$entry->date = date('Y-m-j');
    		$entry->status_user = 0; //false почему то записывает в базу
    		$entry->save();
    		 
    		$session->setFlash('addEntry', 'Заявка на вступление в группу подана! ');
    	}
    	
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAccept($group_id, $user_id)
    {
    	//принимаем пользователя в группу
    	Yii::$app->db->createCommand()->update('entry', ['status_user' => true], ['user_id' => $user_id,
    		'group_id' => $group_id,
    		])->execute();
    	 
    	$session = Yii::$app->session;
    	$session->setFlash('acceptEntry', 'Пользователь принят в вашу группу!');
    	return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionReject($group_id, $user_id)
    {
    	//отклоняем заявку пользователя на вступление в группу
    	Yii::$app->db->createCommand()->delete('entry', ['user_id' => $user_id,
    													'group_id' => $group_id,])
    		->execute();
    
    	$session = Yii::$app->session;
    	$session->setFlash('acceptEntry', 'Заявка пользователя удалена!');
    	return $this->redirect(Yii::$app->request->referrer);
    }

}
