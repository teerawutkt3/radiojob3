<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 	#006363	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
}
</style>
<div class="user-index">
    <div class="panel panel-default">
         <div class="panel-body panel-body1">
            <a href="../user/user-total" class="btn btn-default" >ทั้งหมด</a>	
        	<a href="../user/user-radiologist" class="btn btn-info" >นักรังสีเทคนิค</a>
        	<a href="../user/user-public_relations" class="btn btn-primary" >ผู้ประกาศ</a>
		</div>
    </div>
</div>
