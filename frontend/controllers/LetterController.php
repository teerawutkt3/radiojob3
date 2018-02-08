<?php

namespace frontend\controllers;

use common\models\Messages;
use yii\web\NotFoundHttpException;
use frontend\models\MessageSearch;
use frontend\models\MessageSenderSearch;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class LetterController extends \yii\web\Controller
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => [
                        
                        ],
                        'roles' => ['?'] //ยังไม่ได้ login
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ]
            ]
        ];
    }
    public function actionIndex(){
        $searchModel = new MessageSearch();
     
        $dataProvider = $searchModel->search(\Yii::$app->request->post());
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionSendTotal(){
        $searchModel = new MessageSenderSearch();
        
        $dataProvider = $searchModel->search(\Yii::$app->request->post());
        
        return $this->render('send-total' , [
            'searchModel' => $searchModel, 'dataProvider' => $dataProvider, ] ); 
    } 
            
    public function actionSend()
    {
        if ($_GET){
             $touser = $_GET['touserid']; 
         
        }else $touser = null;
        $model = new Messages();
        if ($model->load(\Yii::$app->request->post())){
          
            $model->to_user_id = $touser;
            $model->created_by_user_id = \Yii::$app->user->id;
            $model->message_created_at = time();
            $model->message_updated_at = time();
            if ($model->save()){
                return $this->redirect('send');
            }else  throw new NotFoundHttpException('ไม่สามารถทำการบันทึกได้');
        }
        return $this->render('send',
            [
                'model' => $model,
            ]);
    }
    
    public function actionDelete($id){
        $model = Messages::findOne($id);
        $model->delete();
        return $this->redirect('/letter/index');
    }
    


}
