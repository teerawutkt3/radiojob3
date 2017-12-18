<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้ทั้งหมด', 'url' => ['user-total']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 	#006363	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
}
.panel-body2 {
background: 	#BEBEBE	;
color:#000000;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
}
} 
}
</style>
    <div class="panel panel-default">
         <div class="panel-body panel-body1">
            <a href="../user/user-total" class="btn btn-default" >ทั้งหมด</a>	
        	<a href="../user/user-radiologist" class="btn btn-info" >นักรังสีเทคนิค</a>
        	<a href="../user/user-public_relations" class="btn btn-primary" >ผู้ประกาศ</a>
		</div>
    </div> <!-- end panel -->
  
<div class="user-view">
<hr>
    <div class="row">

    	<div class="col-md-9">
            <div class="panel panel-default">
           		 <div class="panel-body panel-body2">
           					<div class="row">
           						<div class="col-md-9"></div>
           						<div class="col-md-3"><p class="text-danger">สิทธิ์การใช้งาน : </p></div>
           					</div>
           		 			<p><b>ชื่อผู้ใช้ : </b><?= $model->username; ?></p>
           		 			<p><b>ชื่อ - สกุล : </b><?= $model->fname."   ".$model->lname ?></p>
           		 			<p><b>Email : </b><?= $model->email ?></p>
           		 			<hr>
           		 			<p><b>สมัครเข้าใช้งานเมื่อ : </b><?= Yii::$app->formatter->asDatetime($model->created_at) ?></p>
           		 			<p><b>แก้ไข : </b><?=  Yii::$app->formatter->asDatetime($model->updated_at) ?></p>
           		 		
           		 </div>
          	</div>
      	</div>
      	    	<div class="col-md-3">
      	    	  <p>
                    <?= Html::a('<span class="	glyphicon glyphicon-cog"></span> เปลี่ยนแปลงสิทธิ์การใช้งาน', ['#', 'id' => $model->id], [
                        'class' => 'btn btn-warning btn-block btn-lg',
                        'data' => [
                            'confirm' => 'ยืนยันการบล๊อคผู้ใช้งาน',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
    			<p>
                    <?= Html::a('<span class="glyphicon glyphicon-lock"></span> บล๊อค', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-block',
                        'data' => [
                            'confirm' => 'ยืนยันการบล๊อคผู้ใช้งาน',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
    	</div>
  	</div>


</div>
