<?php

use yii\helpers\Html;
use common\models\Work;

/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = "id : ".$model->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 

</style>
<div class="work-view">
		    	
    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" >งานประกาศ  </h3></div>
    </div>
		<div class=" col-md-8">


             <div class="panel panel-default">
                             
                                      <div class="panel-body ">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-10">
                                      		<h4 class="text-center"><span class="glyphicon glyphicon-home"></span> <?=$model->name_office?></h4>
                                    		
                                    		<p class="text-center"><span class="glyphicon glyphicon-calendar"> </span> ประกาศเมื่อ : <?=Yii::$app->formatter->asDatetime($model->work_created_at,'dd MMM yyyy kk:mm')?></p>
                                    		
                                    	
                                    	
                                    		<p ><span class="glyphicon glyphicon-pushpin"></span> <b>สังกัด  : </b><?=$model->belong?></p>
                                    		<p ><span class="	glyphicon glyphicon-ok-sign"></span> <b>รับสมัครจำนวน  : </b><?=$model->number?> ตำแหน่ง</p>
                                                    		<b><span class="glyphicon glyphicon-list-alt"></span> รายละเอียด</b>
                                                    	
                                                    		<p><?= Yii::$app->formatter->asNtext($model->description)?></p>
                                                    		
                                                    		<br><p><span class="glyphicon glyphicon-time"></span><b> เวลาทำงาน : </b><?=Yii::$app->formatter->asTime($model->time_begin,'kk:mm')?> 
                                                    					ถึง <?=Yii::$app->formatter->asTime($model->time_end,'kk:mm')?>
                                                    		</p>
                                                    		<hr>
                                                    	
                                                    		
                                                    		<p><span class="glyphicon glyphicon-check"></span> <b> สวัสดิการ  </b></p>	
                                                    		<p>	 <?= Yii::$app->formatter->asNtext($model->benefits)?></p>	
                                                    		<!-- <p><span class="glyphicon glyphicon-object-align-bottom"></span><b> คุณสมบัติ </b></p> -->
                                                    		
                                                    			<hr>
                                                    		<p><span class="glyphicon glyphicon-usd"></span> <b> รายได้ : </b>
                                                    				<?php if ($model->money2 ==NULL){
                                                    				    echo $model->money1;
                                                    				}else{
                                                    				    echo $model->money1." - ".$model->money2;
                                                    				}
                                                    				   ?>
                                                    			 บาท
                                                    		 </p>
                                                    		 <p><span class="glyphicon glyphicon-earphone"></span> <b>โทร : </b> <?=$model->tel?></p>
                                                    		 <p><span class="glyphicon glyphicon-map-marker"></span> <b>ที่ตั้ง : </b><?=$model->address->nameAddress?></p>
                                                    		<hr>
                                                    		<?php if ($model->work_status == Work::STATUS_ACTIVE ) {?>
                                                			<div class="pull-right">
                                                					  <?php if (Yii::$app->user->can('public_relations')){?>
                                                			       <?= Html::a('', ['update', 'id' => $model->id], ['title'=>'แก้ไข','class' => 'btn btn-success glyphicon glyphicon-pencil']) ?>
                                                                    <?= Html::a('', ['delete', 'id' => $model->id], [
                                                                        'title'=>'ลบ',
                                                                        'class' => 'btn btn-danger 	glyphicon glyphicon-trash',
                                                                        'data' => [
                                                                            'confirm' => 'ยืนยันการลบ',
                                                                            'method' => 'post',
                                                                        ],
                                                                    ]) ?>
                                                                    <?php }?>
                                                			</div>
                                                    <?php }else{ ?>
                                                    <?php }?>
                                                    		</div>
                                      <div class="col-md-1"></div>
            							</div>
                </div>
                </div>
                <div  class="col-md-4">
				<div class="panel panel-default">
                  <div class="panel-heading">รายชื่อ
                  </div>
                  <div class="panel-body">
                  <?php if ($join_work_success != 0){?>
                  <?php foreach ($join_work_success as $data){?>
                  	<h5><a href="/user/view?id=<?=$data->user_id?>" target="_blank" title="ดูโปรไฟล์"> <?=$data->user->fullName?> <?=Yii::$app->formatter->asDate($data->join_updated_at)?></a>
                  <div class="pull-right"><span class="label label-danger "> เสร็จสิ้น</span></div> </h5>
                  <?php }}if ($join_work_action!= 0){?>
                    <?php foreach ($join_work_action as $data){?>
                  <h5><a href="/user/view?id=<?=$data->user_id?>" target="_blank" title="ดูโปรไฟล์"><?=$data->user->fullName?> <?=Yii::$app->formatter->asDate($data->join_updated_at)?></a>
                  <div class="pull-right"><span class="label label-info "> ยืนยันแล้ว</span> 
                  <?php if (Yii::$app->user->can('public_relations')){?>
                  	<?=Html::a(' เสร็จสิ้น',['/joinwork/successjoin?id='.$data->id],[
                 	                                    'class' => 'btn btn-danger btn-xs glyphicon glyphicon-ok',
                 	                                    'title' => 'เสร็จสิ้นการทำงาน',
                 	                                    'data' => [
                 	                                        'confirm' => 'เสร็จสิ้นการทำงาน',
                 	                                        'method' => 'post',
                 	                                    ],
                 	                                ]);?>	
				<?php }?>                 	                                
                  </div> </h5>
                  <?php }?>
                  
                  <?php }else{?>
                    <?php if ($join_work ==null && $join_work_action==0 &&$join_work_success==0){?>
					<?php echo "ยังไม่มีผู้สมัคร "?>
					<?php }else{ ?>
                  	<?php foreach ($join_work as $data):?>
					<h5><a href="/user/view?id=<?=$data->user_id?>" target="_blank" title="ดูโปรไฟล์"> <?=$data->user->fullName?> <?=Yii::$app->formatter->asDate($data->join_created_at)?></a>
					<div class="pull-right">
					<!-- <span class="label label-success "> เคยร่วมงาน</span>  -->
					<?php if(Yii::$app->user->can('radiologist')){?>
					    <span class="label label-warning "> รอการยืนยัน</span> 
					<?php }?>
					  <?php if (Yii::$app->user->can('public_relations')){?>
					<?=Html::a('<span class="glyphicon glyphicon-ok"></span> รับสมัคร',['/joinwork/acceptjoin?id='.$data->id],[
                 	                                    'class' => 'btn btn-success btn-xs ',
                 	                                    'title' => 'รับสมัคร',
                 	                                    'data' => [
                 	                                        'confirm' => 'ยืนยันการรับสมัคร',
                 	                                        'method' => 'post',
                 	                                    ],
                 	                                ]);?>	
					<?php }?>                 	                                
                 	   </div>  </h5>                   
					<?php endforeach; }?>
					<?php }?>
					
                  </div>
                </div>
				
                </div>
</div>

