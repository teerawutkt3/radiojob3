<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการสิทธิ์การใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 
th {
background: 	#009999	;
color : #FFFFFF;
}

</style>
<div class="auth-assignment-index">
    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> ผู้ใช้งาน / <?= Html::encode($this->title) ?></h3></div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Auth Assignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php   Pjax::begin([
		'enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> 
		 <?php $form = ActiveForm::begin(); ?>
			<div class="row">
					<div class="col-md-3"> <?= $form->field($searchModel, 'item_name')->dropDownList(
					    ArrayHelper::map(AuthItem::find()->all(), 'name', 'description'),  [
					        'prompt' => ' สิทธ์การใช้งาน ',
					    ]
					    )?></div>
			
					
					<div class="col-md-3">   <?= $form->field($searchModel, 'nameSearch')->textInput(['placeholder'=>'ชื่อ']) ?></div>
					
					<div class="col-md-3"> <?= $form->field($searchModel, 'lastSearch')->textInput(['placeholder'=>'นามสกุล'])?></div>
					<div class="col-md-3"> 
					    <div class="form-group"><br>
                            <?= html::submitButton('<span class="glyphicon glyphicon-search"></span> ค้นหา',['class'=>'btn btn-warning 	'])?>
                        </div>
					</div>
			</div>
    <?php ActiveForm::end(); ?>
    <hr>
    <div style="height:800px; overflow:auto">
<table class="table table-bordered table-hover table-striped	" >
    <thead>
      <tr >
        <th class="text-center" style="width: 50px">ลำดับ</th>
        <th class="text-center">ชื่อ - นามสกุล</th>
        <th class="text-center">email</th>
        <th class="text-center">สิทธิ์การใช้งาน</th>
        <th  style="width: 80px"></th>
      </tr>
    </thead>
    <tbody>
  
    <?php $count=0; foreach ($dataProvider->models as $data):?>
      <tr>
      <td><?=++$count?></td>
        <td><?=$data->user->fullname?></td>
        <td><?=$data->user->email?></td>
        <td class="text-center"><?php 
                    if ($data->itemName->description == 'นักรังสีเทคนิค'){
                        echo '<span class="label label-success">'.$data->itemName->description.'</span>';
                    }else echo  '<span class="label label-primary">'.$data->itemName->description.'</span>';
        ?></td>
        <td>
        <?=html::a('เปลี่ยนแปลงสิทธิ์  <span class=" glyphicon glyphicon-cog"></spab>','change?id='.$data->user->id,['class'=> 'btn btn-default'])?>
       
        
        </td>
     </tr>
       
     <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php Pjax::end(); ?></div>
