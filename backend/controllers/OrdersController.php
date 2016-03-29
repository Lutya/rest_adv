<?php

namespace backend\controllers;

use Yii;
use frontend\models\orders\Orders;
use frontend\models\orders\OrdersSearch;
use frontend\models\order_consist\OrderConsist;
use backend\models\dish\Dish;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    public function behaviors()
    {
        return [
	        'access' => [
	            'class' => AccessControl::className(),
	        	//'only' => ['create', 'update'],
	            'rules' => [
	                [
	                    //'actions' => ['create', 'delete', 'update', 'view'],
	                    'allow' => true,
	                	'actions' => ['create', 'update', 'view', 'index', 'delete', 'delconsist', 'statusfilter'],
	                    'roles' => ['manager'],
	                ],
	            ],
	        ],
	    ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$query = OrderConsist::find()
    		->where(['order_id' => $id]);
    	
    	$dataProvider = new ActiveDataProvider([
    				'query' => $query,
    		]);
    	
    	$consist = OrderConsist::findAll(['order_id' => $id]);
    	$total_sum = 0;
    	foreach ($consist as $cons) {
    		$total_sum = $total_sum + $cons->count * $cons->dish->price;
    	}
    	
    	
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'dataProvider' => $dataProvider,
        	'total_sum' => $total_sum,
        ]);
        
        
        
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($order_id)
    {
        $model = new Orders();
        //$order_id = uniqid('OR');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['orderconsist/create',
            		'order_id' => $order_id,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'order_id' => $order_id,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($type, $id_order, $id_dish)
    {
    	//$model = $this->findModel($id);
    	
        $session = Yii::$app->session;
    	$order_consist = OrderConsist::findOne(['order_id'=>$id_order,
    									  		'dish_id'=>$id_dish
    	]);
    	if($type == 'minus'){
    		if ($order_consist->count == 1) {
    			$order_consist->delete();
    			$session->setFlash('updateOrder', 'Удалено');
    		}
    		else {
    			$order_consist->updateCounters(['count' => -1]);
    			$session->setFlash('updateOrder', 'Уменьшено');
    		}	
    	}	
    	elseif($type == 'plus'){
    		$order_consist->updateCounters(['count' => 1]);
    		$session->setFlash('updateOrder', 'Добавлено');
    	}
    	else $session->setFlash('updateOrder', 'Нет такой команды');
    	
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Deletes an existing Order's consist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelconsist($id)
    {
    	$session = Yii::$app->session;
    	OrderConsist::findOne($id)->delete();
    	$session->setFlash('updateOrder', 'Удалено');
    
    	return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAlterstatus($order_id, $status)
    {
    	$order = Orders::findOne($order_id);
    	if ($status == 'open') 
    		$order->order_status_id = 1;
    	elseif ($status == 'work')  
    		$order->order_status_id = 2;
    	else 
    		$order->order_status_id = 3;
    	$order->save();
    	return $this->redirect(Yii::$app->request->referrer);
    }  
    
    
    public function actionStatusfilter($status_id)
    {
    	/*$query = Orders::find()
    		->where(['order_status_id' => 1]);*/
    	
    	$searchModel = new OrdersSearch();
    	/*$dataProvider =  ([
    			'query' => $query,
    	]);*/
    	
    	//$searchModel->order_status_id = '1';
    	
        $dataProvider = $searchModel->searchstatus(Yii::$app->request->queryParams, $status_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	//return $this->redirect(Yii::$app->request->referrer);
    }
 

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
