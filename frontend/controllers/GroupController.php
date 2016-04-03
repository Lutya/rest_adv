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
        
        //проверяем есль ли заявки на вступление в группу
        
        
        
        
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
    public function actionView($id)
    {
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
    		
    	$users = Entry::find()
    		->where(['group_id' => $id,
    				'status_user' => false,
    		]);
    	
    	$userProvider = new ActiveDataProvider([
    			'query' => $users,
    	]);
    	
    	
    	$usersInGroup = Entry::find()
    		->where(['group_id' => $id,
    				'status_user' => true,
    		]);
    	
    	$usersIngroupProvider = new ActiveDataProvider([
    				'query' => $usersInGroup,
    		]);
        return $this->render('view', [
        	'userProvider' => $userProvider,
        	'usersIngroupProvider' => $usersIngroupProvider,
            'model' => $this->findModel($id),
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
