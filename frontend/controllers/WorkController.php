<?php

namespace frontend\controllers;

use Yii;
use common\models\Work;
use frontend\models\WorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Address;
use common\models\Geography;
use common\models\Provinces;
use common\models\Amphures;
use common\models\Districts;
use common\models\Zipcodes;
use common\models\Fulladdress;
use common\components\MyDate;
use frontend\models\WorkSearchSort;
use frontend\models\WorkSearchNormal;
use frontend\models\WorkSearchMap;
use common\models\Joinwork;
use common\models\Schedule;
use frontend\models\WorkSearchBenefits;
use frontend\models\UserRadiologistSearch;
use common\models\AuthAssignment;
use common\models\Calendar;


/**
 * WorkController implements the CRUD actions for Work model.
 */
class WorkController extends Controller
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
//             'access' => [
//                 'class' => AccessControl::className(),
//                 'rules' => [
//                     [
//                         'allow' => true,
//                         'actions' => [
//                             'index'
//                         ],
//                         'roles' => ['@'] //ยังไม่ได้ login
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => [  
//                             'work-search-normal',
//                             'work-search-view',
//                             'work-search-sort'
//                         ],
//                         'roles' => ['?'],
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => [
//                             'index','view'
//                         ],
//                         'roles' => ['admin']
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => [
//                             'create','delete','index','view','update'
//                         ],
//                         'roles' => ['hospital']
//                     ],
                    
//                 ]
//             ]  
        ];
    }

    /**
     * Lists all Work models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $inbox = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'created_work'=>\Yii::$app->user->id])->count();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'inbox' => $inbox,
        ]);
    }
    // Work Search
    public function actionWorkSearch(){
        $searchModel = new WorkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;  
        return $this->render('work-search',[
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
           // 'check_join_work'=>$check_join_work,
        ]);
    }
    public function actionWorkSearchSort(){
        $searchModel = new WorkSearchSort();
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        //    $dataProvider->query->where(['work_status'=>Work::STATUS_ACTIVE]);
        // $check_join_work = JoinWork::find()->where(['user_join_id'=>\Yii::$app->user->id])->all();
        return $this->render('work-search-sort',[
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
            // 'check_join_work'=>$check_join_work,
        ]);
    }
    public function actionWorkSearchSortList(){
        $searchModel = new WorkSearchSort();
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        //    $dataProvider->query->where(['work_status'=>Work::STATUS_ACTIVE]);
        // $check_join_work = JoinWork::find()->where(['user_join_id'=>\Yii::$app->user->id])->all();
        return $this->render('work-search-sort-list',[
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
            // 'check_join_work'=>$check_join_work,
        ]);
    }
    public function actionWorkSearchNormal(){
        $searchModel = new WorkSearchNormal();
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        //    $dataProvider->query->where(['work_status'=>Work::STATUS_ACTIVE]);
        // $check_join_work = JoinWork::find()->where(['user_join_id'=>\Yii::$app->user->id])->all();
        return $this->render('work-search-normal',[
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
            // 'check_join_work'=>$check_join_work,
        ]);
    }
    public function actionWorkSearchNormalList(){
        $searchModel = new WorkSearchNormal();
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        return $this->render('work-search-normal-list',[
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
            // 'check_join_work'=>$check_join_work,
        ]);
    }
    public function actionWorkSearchMap(){
        $searchModel = new WorkSearchMap();
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        
      //  $model = WorkSearchMap::find()->all();
        return $this->render('work-search-map',[
            'searchModel' => $searchModel,
            'dataProvider'=>$dataProvider,
            'count' => $count
        ]);
    }
    public function actionWorkSearchBenefits(){
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $searchModel = new  WorkSearchBenefits();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;   
        //  $model = WorkSearchMap::find()->all();
        return $this->render('work-search-benefits',[
            'searchModel' => $searchModel,
            'dataProvider'=>$dataProvider,
            'count' => $count
        ]);
    }
    public function actionWorkSearchBenefitsList(){
        if (\Yii::$app->user->isGuest) $this->layout = 'main3';
        $searchModel = new  WorkSearchBenefits();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count = $dataProvider->count;  
        //  $model = WorkSearchMap::find()->all();
        return $this->render('work-search-benefits-list',[
            'searchModel' => $searchModel,
            'dataProvider'=>$dataProvider,
            'count' => $count
        ]);
    }
    
    public function actionWorkSearchView($id){
        $count_join = Joinwork::find()->where(['work_id'=>$id,'join_status' => Joinwork::STATUS_WAIT])->count();
        //var_dump($count_join);die();
        return $this->renderPartial('work-search-view',[
            'model'=>$this->findModel($id),
            'count_join' => $count_join,
        ]);
    }
    public function actionWorkUserView($id){
        $count_join = Joinwork::find()->where(['work_id'=>$id])->count();
        //var_dump($count_join);die();
        return $this->renderPartial('work-user-view',[
            'model'=>$this->findModel($id),
            'count_join' => $count_join,
        ]);
    }
    
    public function actionWorkSearchRadiologist(){
        $searchModel = new  UserRadiologistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        $count_auth = AuthAssignment::find()->where(['item_name'=>'radiologist'])->count();
        $count = $dataProvider->count;  
        //  $model = WorkSearchMap::find()->all();
        return $this->render('work-search-radiologist',[
            'searchModel' => $searchModel,
            'dataProvider'=>$dataProvider,
            'count_auth'=>$count_auth,
            'count' => $count,
        ]);
    }
    
    public  function actionWorkSchedule(){
         if ($_GET){
             $id = $_GET['id'];
         }
        
        $check_schedule = Schedule::findOne(['user_id'=>$id]);
        if ($check_schedule == null){
            $schedule = new Schedule();
        }else{
            $schedule = Schedule::findOne(['user_id'=>\Yii::$app->user->id]);
        }
        if ($schedule->load(\Yii::$app->request->post())){
  
            $schedule->user_id = \Yii::$app->user->id;
            if ($schedule->save()){
                return $this->redirect('work-schedule?id='.$id);
            }
        }
               
        return $this->render('work-schedule',[
            'schedule' => $schedule,
        ]);
    }
    public function actionMap(){
        $model = new Work();
        
        return $this->render('map',['model'=>$model,'key'=>'AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk']);
    }


    /**
     * Displays a single Work model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){
        $join_work = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_WAIT,'work_id'=>$id])->orderBy(['join_created_at'=>SORT_DESC])->all();
        $join_work_success = Joinwork::find()->where(['join_status'=> Joinwork::STATUS_SUCCESS,'work_id'=>$id])->count();
        $join_work_action = Joinwork::find()->where(['join_status'=> Joinwork::STATUS_ACTION,'work_id'=>$id])->count();
        if ($join_work_success!=0){
            $join_work_success = Joinwork::find()->where(['join_status'=> Joinwork::STATUS_SUCCESS,'work_id'=>$id])->all();
        }
        if ($join_work_action!=0){
            $join_work_action = Joinwork::find()->where(['join_status'=> Joinwork::STATUS_ACTION,'work_id'=>$id])->all();
        }
      //  var_dump($join_work_success); die();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'join_work_success' => $join_work_success,
            'join_work' => $join_work,
            'join_work_action' =>$join_work_action
        ]);
    }
    
    public function actionCalendar($id){
        $calendar = new Calendar();
        $model = Joinwork::find()->where(['user_id'=>$id])->one();
        $data_event = Calendar::find()->where(['user_id'=>$id])->orderBy(['calendar_created_at'=>SORT_DESC])->all();
        if ($calendar->load(\Yii::$app->request->post())){
            //$time = \Yii::$app->formatter->asDatetime($calendar->calendar_created_at,'d M yyyy kk:mm:ss');
            $int = MyDate::Time2int($calendar->calendar_created_at);
            $calendar->calendar_created_at = $int;
            $calendar->user_id = $id;
            $calendar->save();
            return $this->redirect('calendar?id='.$id);
        }
        return $this->render('calendar',[
            'model'=>$model,
            'calendar' => $calendar,
            'data_event' => $data_event,
        ]);
    }
    public function actionDeletecalendar(){
    
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];
        $calendar = Calendar::find()->where(['id'=>$id])->one();
        $calendar->delete();
        return $this->redirect('calendar?id='.$user_id);
    }
    
  

    /**
     * Creates a new Work model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Work();
        $address = new Address();
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
                if ($lat_long == null) {
                    $address->lat = "";
                    $address->long = "";
                }else{
                    if ($zipcode==NULL) $address->lat = "";
                    else  $address->lat = $lat_long->LAT;
                    if ($zipcode==NULL) $address->long = "";
                    else $address->long = $lat_long->LONG;
                }
                if ($address->save())
                    $model->work_address_id =  $address->id;
                    $model->work_status = Work::STATUS_ACTIVE;
                    $model->work_user_id = \Yii::$app->user->id;
                    //coutn str benefits
                    $count_benefits = strlen($model->benefits);
                    $model->count_benefits = $count_benefits;
                    if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);

              
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'address'=>$address
            ]);
        }
    }

    /**
     * Updates an existing Work model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $address = Address::find()->where(['id'=>$model->work_address_id])->one();
      
//                              $str = $model->description ;
//                              var_dump($str);
//                              if (strlen($str) > 63){
//                                  var_dump(substr("$str", 0, 63)."...");
//                              }
//                           //   var_dump(  strlen($str ));
//                                     die();
        
                                       
                            
        if ($model->load(Yii::$app->request->post())) {
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
                if ($lat_long == null) {
                    $address->lat = "";
                    $address->long = "";
                }else{
                     if ($zipcode==NULL) $address->lat = "";
                    else  $address->lat = $lat_long->LAT;
                    if ($zipcode==NULL) $address->long = "";
                    else $address->long = $lat_long->LONG;
                }
               
                //var_dump()
              //  var_dump($model->time_begin); 
                if ($address->save()){      
                    $model->work_address_id = $address->id;
                    $model->time_begin = MyDate::Time2int($model->time_begin);
                    $model->time_end = MyDate::Time2int($model->time_end);
                  //  var_dump($model->time_begin); 
                  //  var_dump(\Yii::$app->formatter->asTime($model->time_begin));
                 //   var_dump(\Yii::$app->formatter->asTimestamp($model->time_begin)); die();  //แปลง time 2 int
                    $count_benefits = strlen($model->benefits);
                    $model->count_benefits = $count_benefits;
                    if ($model->save()){
                                return $this->redirect(['view', 'id' => $model->id]);
                                
                        } else return $this->redirect(['view', 'id' => $model->id]);
                    }
                    
                    
                }else echo "address save fail"; die();
                
                
            } else {
            return $this->render('update', [    
                'model' => $model,
                'address'=>$address,
            ]);
        }
    }

    /**
     * Deletes an existing Work model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
      //  var_dump($model); die();
        $address = Address::find()->where(['id'=>$model->work_address_id])->one();
        $address->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Work model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Work the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Work::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
