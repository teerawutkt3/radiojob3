<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\UserSearch;
use common\models\Address;
use common\models\Districts;
use common\models\Provinces;
use common\models\Amphures;
use common\models\Geography;
use common\models\Fulladdress;
use common\models\Zipcodes;
use common\models\UserExtention;
use common\models\Joinwork;
use common\models\Schedule;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user_extention = UserExtention::find()->where(['user_id'=>$id])->one();
        $join_work = Joinwork::find()->where(['user_id' => $id,'join_status' => Joinwork::STATUS_SUCCESS])->all();
        $count_join_work = Joinwork::find()->where(['user_id' => $id,'join_status'=>Joinwork::STATUS_SUCCESS])->count();
        $schedule = Schedule::findOne(['user_id'=>$id]);
        //  var_dump($user_extention->branch); die();
        //         if (!$user_extention){
        //             $user_extention = null;
        //         }
            return $this->render('view', [
                'model' => $this->findModel($id),
                'user_extention'=>$user_extention,
                'join_work' => $join_work,
                'count_join_work' =>$count_join_work,
                'schedule'=>$schedule,
            ]);
    }
    
    public function actionResume($id){
        $user = User::findOne(['id'=>$id]);
        $userextention  = UserExtention::findOne(['user_id'=>$id]);
        $mpdf = new \mPDF();
        $data = '<h3 class="text-center">'.$user->fname.' '.$user->lname.'</h3>';
        $mpdf->WriteHTML($data);
        
        $mpdf->Output();
        exit();
       /* return $this->render('resume',[
           'model'=>$this->findModel($id)
       ]); */
    }
   

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->id == $id){
        $model = $this->findModel($id);
        
        $address = Address::find()->where(['id'=>$model->address_id])->one();
        $user_extention = UserExtention::find()->where(['user_id'=>$model->id])->one();
        if (!$user_extention){
            $user_extention = new UserExtention();
        }
        if (!$address){
            $address = new Address();
        }
        if ($model->load(Yii::$app->request->post()) ) {
                if ($address->load(\Yii::$app->request->post())){
                    
                    /* geo */
                    $geo = Geography::findOne($address->geo_id);
                              $address->geo_name = $geo->GEO_NAME;
                    /* province */          
                    $province = Provinces::findOne($address->province_id);
                               $address->province_code = $province->PROVINCE_CODE;
                              $address->province_name = $province->PROVINCE_NAME;
                    /* amphur */          
                    $amphur = Amphures::findOne($address->amphur_id);
                              $address->amphur_code = $amphur->AMPHUR_CODE;
                              $address->amphur_name = $amphur->AMPHUR_NAME;
                    /* district */          
                    $district = Districts::findOne($address->district_id);
                               $address->district_code = $district->DISTRICT_CODE;
                               $address->district_name = $district->DISTRICT_NAME;
                    /* zipcode */      
                   $zipcode = Zipcodes::find()->where(['district_code'=>$address->district_code])->limit(1)->one();
                               if ($zipcode==NULL)$address->zipcode = "";
                               else   $address->zipcode = $zipcode->zipcode;
                 
                            //    var_dump($address->zipcode); die();
                      /* lat long */       
                  $lat_long = Fulladdress::find()->where(['DISTRICT_CODE'=>$address->district_code])->limit(1)->one();
                               if ($zipcode==NULL) $address->lat = "";
                               else  $address->lat = $lat_long->LAT;
                               if ($zipcode==NULL) $address->long = "";
                               else $address->long = $lat_long->LONG;
            
                         if ($address->save()){
                             $model->address_id = $address->id;
                             if ($model->save()){
                                 if ($user_extention->load(\Yii::$app->request->post())){
                                      $user_extention->user_id = $model->id;
                                      if ($user_extention->save())
                                           return $this->redirect(['view', 'id' => $model->id]);
                                     
                                 } else return $this->redirect(['view', 'id' => $model->id]);
                             }
                               
                             
                         }else echo "address save fail"; die();
                     
                       
                }
          
        } else {
            return $this->render('update', [
                'model' => $model,
                'address' => $address,
                'user_extention'=>$user_extention,
            ]);
        }
        }else  throw new NotFoundHttpException('ไม่สามารถแก้ไขข้อมูลผู้ใช้งานอื่นได้');
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
