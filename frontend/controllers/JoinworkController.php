<?php

namespace frontend\controllers;

use Yii;
use common\models\Joinwork;
use frontend\models\JoinworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\JoinworkInboxSearch;
use frontend\models\JoinworkAcceptSearch;
use frontend\models\JoinworkSuccessSearch;
use common\models\Work;

/**
 * JoinworkController implements the CRUD actions for Joinwork model.
 */
class JoinworkController extends Controller
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
    
    public function actionRegister($id){
         $model = new Joinwork();
         $model->work_id = $id;
         $model->created_work   = $model->work->work_user_id; 
         $model->user_id = \Yii::$app->user->id;
         $model->join_status = Joinwork::STATUS_WAIT;
        if ( $model->save())   return $this->redirect('/work/work-search-normal');
        else  throw new NotFoundHttpException('ไม่สามารถทำการบันทึกได้');
    }
    
    public function actionAcceptjoin($id){
        $model = $this->findModel($id);
        $model->join_status = Joinwork::STATUS_ACTION;
       
        if ($model->save()){
            $close_join_work = Joinwork::find()->where(['work_id'=>$model->work_id,'join_status'=>Joinwork::STATUS_ACTION])->count();
            
            $work = Work::find()->where(['id'=>$model->work_id])->one();
            //   var_dump($close_join_work); echo"<br>"; var_dump($work);die();
            if ($close_join_work == $work->number){
                $work->work_status = Work::STATUS_DELETED;
                $work->save();
            }
            return $this->redirect('/joinwork/inbox-of-radiologist');
        }else      throw new NotFoundHttpException('ไม่สามารถทำการบันทึกได้');
        
        
    }
    public function actionSuccessjoin($id){
        $model = $this->findModel($id);
        $model->join_status = Joinwork::STATUS_SUCCESS;
        if ($model->save()){
            return $this->redirect('/joinwork/accept-of-radiologist');
        }else      throw new NotFoundHttpException('ไม่สามารถทำการบันทึกได้');
        
    }

    /**
     * Lists all Joinwork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JoinworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionInboxOfRadiologist(){
        $searchModel =  new JoinworkInboxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $inbox = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'created_work'=>\Yii::$app->user->id])->count();
        return $this->render('inbox-of-radiologist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'inbox' => $inbox,
        ]);
    }
    
    public function actionAcceptOfRadiologist(){
        $searchModel =new JoinworkAcceptSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->where(['created_work'=>\Yii::$app->user->id,'join_status'=>Joinwork::STATUS_ACTION])->all();
        $inbox = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'created_work'=>\Yii::$app->user->id])->count();
        return $this->render('accept-of-radiologist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'inbox' => $inbox,
    ]);
    }
    public function actionSuccessOfRadiologist(){
        $searchModel =new JoinworkSuccessSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $inbox = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'created_work'=>\Yii::$app->user->id])->count();  
        return $this->render('success-of-radiologist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'inbox' => $inbox,
        ]);
    }
    
    public function actionDataWorkRadiologist(){
        $searchModel = new JoinworkSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());
       // $inbox = Joinwork::find()->where(['created_work'=>\Yii::$app->user->id])->count();
        return $this->render('data-work-radiologist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          //  'inbox' => $inbox,
        ]);
    }

    /**
     * Displays a single Joinwork model.
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
     * Creates a new Joinwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Joinwork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Joinwork model.
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
    public function actionDelete2($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['data-work-radiologist']);
    }

    /**
     * Deletes an existing Joinwork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['inbox-of-radiologist']);
    }

    /**
     * Finds the Joinwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Joinwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Joinwork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
