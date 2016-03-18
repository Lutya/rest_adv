<?php

namespace backend\controllers;

use Yii;
use frontend\models\orders\Orders;
use frontend\models\orders\OrdersSearch;
use frontend\models\order_consist\OrderConsist;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
    	
    	
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'dataProvider' => $dataProvider,
        ]);
        
        
        
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
