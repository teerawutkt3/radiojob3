<?php

namespace frontend\controllers;

use Yii;
use common\models\Belong;
use frontend\models\BelongSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\widgets\Alert;

/**
 * BelongController implements the CRUD actions for Belong model.
 */
class BelongController extends Controller
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
     * Lists all Belong models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BelongSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Belong model.
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
     * Creates a new Belong model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Belong();
        $findModel  = Belong::find()->all();
        $alert_repeat = 0;
        if ($model->load(Yii::$app->request->post())){
            // check data repeat
            $check_name_belong = Belong::find()->where(['name_belong'=>$model->name_belong])->all();
            if (!$check_name_belong){
                if (  $model->save() )   return $this->redirect('/work/create');
            }else{
                $alert_repeat = 1;
                return $this->render('create',[
                    'model' => $model,
                    'findModel' => $findModel,
                    'alert_repeat' => $alert_repeat,
                ]);
            }
           
        } else {
            return $this->render('create', [
                'model' => $model,
                'findModel' => $findModel,
                'alert_repeat' => $alert_repeat,
            ]);
        }
    }

    /**
     * Updates an existing Belong model.
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
     * Deletes an existing Belong model.
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
     * Finds the Belong model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Belong the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Belong::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
