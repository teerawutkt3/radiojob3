<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;


class RbacController extends Controller {
    
    /* public function actionInit(){
     $auth = Yii::$app->authManager;
     $auth->removeAll();
     Console::output('Removing All! RBAC.....');
     
     $manageUser = $auth->createRole('ManageUser');
     $manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
     $auth->add($manageUser);
     
     $author = $auth->createRole('Author');
     $author->description = 'สำหรับการเขียนบทความ';
     $auth->add($author);
     
     $management = $auth->createRole('Management');
     $management->description = 'สำหรับจัดการข้อมูลผู้ใช้งานและบทความ';
     $auth->add($management);
     
     $admin = $auth->createRole('Admin');
     $admin->description = 'สำหรับการดูแลระบบ';
     $auth->add($admin);
     
     $auth->addChild($management, $manageUser);
     $auth->addChild($management, $author);
     $auth->addChild($admin, $management);
     
     $auth->assign($admin, 1);
     $auth->assign($management, 2);
     $auth->assign($author, 3);
     
     Console::output('Success! RBAC roles has been added.');
     } */
    public function actionInit(){
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Removing All! RBAC.....');
        
        $admin = $auth->createRole('admin');
        $admin->description = 'ผู้จัดการสิดทธิ์การใช้งาน';
        $auth->add($admin);
        
        $radiologist = $auth->createRole('radiologist');
        $radiologist->description = 'นักรังสีเทคนิค';
        $auth->add($radiologist);
        
        $public_relations = $auth->createRole('public_relations');
        $public_relations->description = 'ผู้ประกาศงาน';
        $auth->add($public_relations);
        
        
        $auth->assign($admin, 1);
        $auth->assign($public_relations, 2);
        $auth->assign($radiologist, 3);
        Console::output('Success! RBAC roles has been added.');
    }
    
}
?>
