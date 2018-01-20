<?php 
use common\models\Joinwork;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Work;

$this->title = 'ผู้สมัคร';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>
 <div class="row">
    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> <?= Html::encode($this->title) ?></h3></div>
    </div>
 </div>
 <div class="row">
<div class="form-group pull-right">
<?= Html::a('<span class= "glyphicon glyphicon-file"></span> ประกาศ+ ', ['/work/create'], ['title'=>'ประกาศงาน','class' => 'btn btn-info ']) ?> 
<?=Html::a(' <span class="glyphicon  glyphicon-inbox"></span> สมัคร '.($inbox==0?"":"(".$inbox.")"),'/joinwork/inbox-of-radiologist',['class' => 'btn  btn-danger 	'])?> 
<?=Html::a('<span class="	glyphicon glyphicon-th-list"></span> รับสมัครแล้ว','/joinwork/accept-of-radiologist',['class' => 'btn  btn-success'])?> 
<?=Html::a('<span class="	glyphicon glyphicon-list-alt"></span> รายชื่อผู้เคยร่วมงาน','/joinwork/success-of-radiologist',['class' => 'btn  btn-primary'])?> 
</div>
</div>
<?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> 	
 <div class="row">
<?php $form = ActiveForm::begin(); ?>
		
					<div class="col-md-3">   <?= $form->field($searchModel, 'nameSearch')->textInput(['placeholder'=>'ชื่อ']) ?></div>
					
					<div class="col-md-3"> <?= $form->field($searchModel, 'lastSearch')->textInput(['placeholder'=>'นามสกุล'])?></div>
					<div class="col-md-3"> 
					    <div class="form-group"><br>
                            <?= html::submitButton('<span class="glyphicon glyphicon-search"></span> ค้นหา',['class'=>'btn btn-warning 	'])?>
                        </div>
					</div>
			
    <?php ActiveForm::end(); ?>
</div>
<table class="table table-bordered table-hover table-striped	">
    <thead>
      <tr >
        <th class="text-center" style="width: 50px">ลำดับ</th>
        <th class="text-center">ชื่อสถานที่ทำงาน</th>
        <th class="text-center">ชื่อ - นามสกุล</th>
        <th class="text-center">สมัครเมื่อ</th>
        <th class="text-center">สถานะ</th>
        <th style ="width:20%"></th>
      </tr>
    </thead>
    <tbody>
    <?php $count=0; foreach ($dataProvider->models as $data):?>
    <?php if ($data->join_status == Joinwork::STATUS_WAIT && $data->created_work == Yii::$app->user->id){?>
      <tr>
      <td><?=++$count?></td>
        <td><?=$data->work->name_office?></td>
        <td><?=$data->user->fullname?></td>
        <td><?=Yii::$app->formatter->asDatetime($data->join_created_at)?></td>
        <td class="text-center"><?php   if ($data->join_status == Joinwork::STATUS_WAIT ) {
                 	                            echo  '<span class="label label-warning">รอการยืนยัน</span>';
        }else if ($data->join_status == Joinwork::STATUS_ACTION){
                 	                            echo  '<span class="label label-success">อยู่ในการทำงาน</span>';
                 	              }else echo  '<span class="label label-danger">เสร็จสิ้น</span>';?>
        </td>
        <td>
        <?= Html::a(' ','/user/view?id='.$data->user_id, [
                 	                                    'class'=>'btn btn-default    	glyphicon glyphicon-user',
                 	                                    'title'=>'ดูรายละเอียดผู่้สมัคร'
                 	                                ]);?>
        <?= Html::a(' ','/work/view?id='.$data->work_id, [
                 	                                    'class'=>'btn btn-info     glyphicon glyphicon-eye-open',
                 	                                    'title'=>'ดูรายละเอียดงาน'
                 	                                ]);?>
		<?php  /*  Html::a('',['/joinwork/acceptjoin?id='.$data->id],[
                 	                                    'class' => 'btn btn-success glyphicon glyphicon-ok',
                 	                                    'title' => 'รับสมัคร',
                 	                                    'data' => [
                 	                                        'confirm' => 'ยืนยันการรับสมัคร',
                 	                                        'method' => 'post',
                 	                                    ],
                 	                                ]); */?>        
		<!-- Trigger the modal with a button -->
		<?php
		//$close_join_work_where_acception = Joinwork::find()->where(['work_id'=>$data->work_id,'join_status'=>Joinwork::STATUS_ACTION])->count();
	//	$close_join_work_where_success = Joinwork::find()->where(['work_id'=>$data->work_id,'join_status'=>Joinwork::STATUS_SUCCESS])->count();
		//$close_join_work = $close_join_work_where_acception+$close_join_work_where_success;
		$work = Work::find()->where(['id'=>$data->work_id])->one();
		if ($work->work_status == Work::STATUS_DELETED){?>
		<button type="button" class="btn btn-success" disabled="disabled" ><span class=" glyphicon glyphicon-ok "></span></button>
		<?php } else{?>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ok<?=$data->id?>"><span class=" glyphicon glyphicon-ok "></span></button>
      <?php }?>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$data->id?>"><span class=" glyphicon glyphicon-trash "></span></button>                                                                    
                                                                                  	                                         	                                
		<?php  /*  Html::a('', 'delete?id='.$data->id, [
                 	                                        'class'=>'btn btn-danger glyphicon glyphicon-trash',
                 	                                        'title'=>'ลบ',    
                 	                                        'data' => [
                 	                                            'confirm' => 'ยืนยันการลบ',
                 	                                            'method' => 'post',
                 	                                        ],
                 	                                    ]); */?>    
                 	                                    
                 	                                           <!-- Modal OK-->
                                                                            <div class="row">
                                                                            	<div class="col-md-3">
                                                                            	<div id="ok<?=$data->id?>" class="modal fade" role="dialog">
                                                                              <div class="modal-dialog">
                                                                            
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                  
                                                                                  <div class="modal-body">
                                                                                    <h3 class="text-center">ยืนยันการรับสมัคร</h3>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-3">
                                                                                    <a class="btn btn-success btn-lg btn-block " href="/joinwork/acceptjoin?id=<?=$data->id?>"   method="post"  >   <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</a>
                                                                                  
                                                                                    </div>
                                                                                    <div class="col-md-3">   
                                                                                    <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"> 
                                                                                    <span class="	glyphicon glyphicon-remove-sign"></span> ยกเลิก</button>
                                                                                    </div>
                                                                                    <div class="col-md-3"></div><br><br><br><br>
                                                                                 </div>
                                                                                  </div>
                                                                             
                                                                                </div>
                                                                            
                                                                              </div>
                                                                            </div>
                                                                            	</div>
                                                                            </div>    <!-- end Modal -->
                                                                              <!-- Modal OK-->
                                                                            <div class="row">
                                                                            	<div class="col-md-3">
                                                                            	<div id="delete<?=$data->id?>" class="modal fade" role="dialog">
                                                                              <div class="modal-dialog">
                                                                            
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                  
                                                                                  <div class="modal-body">
                                                                                    <h3 class="text-center">ยืนยันการลบ</h3>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-3">
                                                                                   
                                                                                  	<?=  Html::a('<span class="	glyphicon glyphicon-ok-sign"></span> ตกลง', 'delete?id='.$data->id, [
                                                 	                                        'class'=>'btn btn-success btn-lg btn-block ',
                                                 	                                        'title'=>'ลบ',    
                                                 	                                        'data' => [
                                                 	                                          
                                                 	                                            'method' => 'post',
                                                 	                                        ],
                                                 	                                    ]); ?>    
                                                                                    </div>
                                                                                    <div class="col-md-3">   
                                                                                    <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"> 
                                                                                    <span class="	glyphicon glyphicon-remove-sign"></span> ยกเลิก</button>
                                                                                    </div>
                                                                                    <div class="col-md-3"></div><br><br><br><br>
                                                                                 </div>
                                                                                  </div>
                                                                             
                                                                                </div>
                                                                            
                                                                              </div>
                                                                            </div>
                                                                            	</div>
                                                                            </div>       <!-- end Modal -->           	                	                           
        </td>
     </tr>
	<?php }?>
     <?php endforeach;?>
    </tbody>
  </table>



  </div>
<div class="col-md-1"></div>
<?php Pjax::end(); ?>
