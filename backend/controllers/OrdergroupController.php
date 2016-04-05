<?php

namespace backend\controllers;

use Yii;
use frontend\models\order_group\OrderGroup;
use frontend\models\order_group\OrderGroupSeacrh;
use frontend\models\order_group_consist\OrderGroupConsist;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * OrdergroupController implements the CRUD actions for OrderGroup model.
 */
class OrdergroupController extends Controller
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
	                	'actions' => ['view', 'index'],
	                    'roles' => ['manager'],
	                ],
	            ],
	        ],
	    ];
    }

    /**
     * Lists all OrderGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderGroupSeacrh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	//сумма всего группового заказа
    	$total_sum = 0;
    	$order_gr_cons = OrderGroupConsist::find()
    	->where([
    			'order_group_id' => $id,
    			'order_group.order_status' => true,
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
    	
    	
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'dishProvider' => $dishProvider,
        	'total_sum' => $total_sum,
        ]);
    }

    /**
     * Finds the OrderGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OrderGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
