<?php

namespace backend\controllers;

use Yii;
use backend\models\dish\Dish;
use backend\models\dish\DishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
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
	                	'actions' => ['create', 'update', 'view', 'index', 'delete'],
	                    'roles' => ['manager'],
	                ],
	            ],
	        ],
	    ];
    }

    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
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
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dish();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        	//$photo_name = $model->name;
        	
        	$model->file=UploadedFile::getInstance($model, 'file');
        	$model->file->saveAs('uploads/'. $model->file->baseName .'.'.$model->file->extension);
        	
        	$model->photo = 'uploads/'. $model->file->baseName .'.'.$model->file->extension;
        	
        	$model->save();
        	
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	$model->file=UploadedFile::getInstance($model, 'file');
        	$model->file->saveAs('uploads/'. $model->file->baseName .'.'.$model->file->extension);
        	 
        	$model->photo = 'uploads/'. $model->file->baseName .'.'.$model->file->extension;
        	 
        	$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
