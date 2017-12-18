<?php

namespace backend\controllers;

use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Contacts;

/**
 * UserController implements the CRUD actions for User model.
 */
class ContactController extends Controller
{
    public function actionView(){
        $model = Contacts::find()->orderBy(['contact_created_at'=>SORT_DESC])->all();
        return $this->render('view',
            [
                'model' => $model,
            ]);
    }
    
    public function actionContactView($id){
            return $this->renderPartial('contact-view',[
                    'model' => $this->findModel($id)               
            ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
   
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
