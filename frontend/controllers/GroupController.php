<?php

namespace frontend\controllers;

use Yii;
use frontend\models\user_group\UserGroup;
use frontend\models\user_group\UserGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\entry\Entry;
use yii\data\ActiveDataProvider;
use frontend\models\order_group_consist\OrderGroupConsist;
use frontend\models\order_group\OrderGroup;

/**
 * GroupController implements the CRUD actions for UserGroup model.
 */
class GroupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $user_id = Yii::$app->user->identity->id;
        
        //находим группы которыми владеет пользователь
        $owner_groups = UserGroup::find()
        	->where(['owner_id' => $user_id]);
        $ownerProvider = new ActiveDataProvider([
        		'query' => $owner_groups,
        		'pagination' => [
        				'pageSize' => 25,
        		],    		
        ]);
        
        //находим группы которыми в которых состоит пользователь
        $entry_groups = Entry::find()
        	->where([
        			'user_id' => $user_id,
        			'status_user' => True,
        	]);
        $entryProvider = new ActiveDataProvider([
        		'query' => $entry_groups,
        ]);
 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'ownerProvider' => $ownerProvider,
        	'entryProvider' => $entryProvider,
        ]);
    }

    /**
     * Displays a single UserGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $filter = 'users')
    {
    	//$filter = 'dishes';
    	//проверяем состоит ли пользователь в этой группе
    	$user_id = Yii::$app->user->identity->id;
    	$in_group = Entry::find()
    		->where([
    				'group_id' => $id,
    				'user_id' => $user_id,
    				'status_user' => true,
    		])
    		->count();
    		//если не состоит в группе то не открывать
    	if ($in_group == 0)
    		throw new \Exception('You are not a member in the group!');
    	
    	//находим пользователей которые подали заявку чтобы войти в группу
    	//отображается только владельцу
    	$users = Entry::find()
    		->where(['group_id' => $id,
    				'status_user' => false,
    		]);
    	
    	$userProvider = new ActiveDataProvider([
    			'query' => $users,
    	]);
    	
    	//находим всех кто состоит в группе
    	$usersInGroup = Entry::find()
    		->where(['group_id' => $id,
    				'status_user' => true,
    		]);
    	
    	$usersIngroupProvider = new ActiveDataProvider([
    				'query' => $usersInGroup,
    		]);
    	 
    	//сумма всего группового заказа
    	$total_sum = 0;
    	$order_gr_cons = OrderGroupConsist::find()
    		->where([
    				'order_group.group_id' => $id,
    				'order_group.order_status' => false,
    		])
    		->joinWith(['orderGroup']);
    		//->all();
    	
    	//находим все блюда в заказе
    	$dishProvider = new ActiveDataProvider([
    			'query' => $order_gr_cons->select(['dish_id', 'SUM(count) AS count', 'order_group_id', 'user_id'])
    						->groupBy(['dish_id', 'order_group_id']),
    						//->sum('count'),
    	]);
    	
    	foreach ($order_gr_cons->all() as $ogc) {
    			$total_sum = $total_sum + $ogc->count * $ogc->dish->price;
    		}
    	
    	//проверяем открытый ли заказ
    	if ($total_sum == 0) 
    		$order_open = false;
    	else 
    		$order_open = true;
        return $this->render('view', [
        	'total_sum' => $total_sum,
        	'userProvider' => $userProvider,
        	'usersIngroupProvider' => $usersIngroupProvider,
            'model' => $this->findModel($id),
        	'order_open' => $order_open,
        	'dishProvider' => $dishProvider,
        	'filter' => $filter,
        ]);
    }

    /**
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$user_id = Yii::$app->user->identity->id;
        $model = new UserGroup();
        $model->date = date('Y-m-j');
        $model->owner_id = $user_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	//заполняем таблицу состава группы
        	$entry = new Entry();
        	$entry->user_id = $user_id;
        	$entry->group_id = $model->id;
        	$entry->date = date('Y-m-j');
        	$entry->status_user = True;
        	$entry->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        //нельзя редактировать если ты не владелец
        $user_id = Yii::$app->user->identity->id;
        if ($user_id !== $model->owner_id)
        	throw new \Exception('You can not update this group!');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	//нельзя удалять если ты не владелец
    	$user_id = Yii::$app->user->identity->id;
    	if ($user_id !== $this->findModel($id)->owner_id)
    		throw new \Exception('You can not delete this group!');
    	
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
    /**
     * Updates an existing UserGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $group_id
     * @return mixed
     */
    public function actionConf($id)
    {
    	//нельзя подтверждать если ты не владелец
    	$user_id = Yii::$app->user->identity->id;
    	if ($user_id !== $this->findModel($id)->owner_id)
    		throw new \Exception('You can not confirm this groups order!');
    	
    	$order_group = OrderGroup::find()
    		->where([
    				'group_id' => $id,
    				'order_status' => false,
    		])
    		->one();
    	$order_group->order_status = true;
    	$order_group->save();
    	
    	$session = Yii::$app->session;
    	$session->setFlash('orderConfirm', 'Заказ отправлен!');

    	return $this->redirect(Yii::$app->request->referrer);
    }
    
    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
