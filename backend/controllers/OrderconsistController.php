<?php

namespace backend\controllers;

use Yii;
use frontend\models\order_consist\OrderConsist;
use frontend\models\orders\Orders;
use frontend\models\orders\OrdersSearch;
use frontend\models\order_consist\OrderConsistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrderconsistController implements the CRUD actions for OrderConsist model.
 */
class OrderconsistController extends Controller
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
	                	'actions' => ['create', 'close', 'index'],
	                    'roles' => ['manager'],
	                ],
	            ],
	        ],
	    ];
    }

    /**
     * Creates a new OrderConsist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($order_id)
    {
        $model = new OrderConsist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'order_id' => $order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'order_id' => $order_id,
            ]);
        }
    }
    
    public function actionClose($order_id)
    {
    	$count = OrderConsist::find()
    		->where(['order_id' => $order_id])
    		->count();
    
    	if ($count > 0) {
    		return $this->redirect(['orders/view', 'id' => $order_id]);
    	} else {
    		$order = Orders::findOne($order_id)->delete();
    		return $this->redirect(['orders/index']);
    	}
    }
    
    public function actionIndex()
    {
    	$searchModel = new OrdersSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    	return $this->render('index', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
}