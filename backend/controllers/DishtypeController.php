<?php

namespace backend\controllers;

use Yii;
use backend\models\dish_type\DishType;
use backend\models\dish_type\DishTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use arturoliveira\ExcelView;

/**
 * DishtypeController implements the CRUD actions for DishType model.
 */
class DishtypeController extends Controller
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
	                	'actions' => ['create', 'update', 'view', 'index', 'delete', 'export'],
	                    'roles' => ['manager'],
	                ],
	            ],
	        ],
	    ];
	}

    /**
     * Lists all DishType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DishType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DishType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DishType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DishType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DishType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionExport() {
    	$searchModel = new DishTypeSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	ExcelView::widget([
    			'dataProvider' => $dataProvider,
    			'filterModel' => $searchModel,
    			'fullExportType'=> 'xlsx', //can change to html,xls,csv and so on
    			'grid_mode' => 'export',
    			'columns' => [
    					['class' => 'yii\grid\SerialColumn'],
    					'id',
    					'name',
    					'full_name',
    			],
    	]);
    }
    
    
    
    /**
     * Finds the DishType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DishType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DishType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
