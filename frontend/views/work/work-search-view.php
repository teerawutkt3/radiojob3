<?php


use common\models\Joinwork;

/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>
<div class="work-view">
             <div class="panel panel-default">
                             
                                      <div class="panel-body ">
                                      <div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10">
										<span class="label label-info glyphicon glyphicon-user">จำนวนผู้สมัคร : <?=$count_join?> </span> 
                                      		<h4 class="text-center"><span class="glyphicon glyphicon-home"></span> <?=$model->name_office?></h4>
                                    		<h5 class="text-center">
                                    		<span class="glyphicon glyphicon-map-marker"></span> <?=$model->address->province_name?><br><br>
                                    		<span class="glyphicon glyphicon-calendar"> ประกาศเมื่อ : วันที่ <?=Yii::$app->formatter->asDatetime($model->work_created_at,'d MMM yyyy kk:mm')?></span>
                                    		
                                    		</h5>
                                    		<p ><span class="glyphicon glyphicon-pushpin"></span> <b>หน่วยงาน  : </b><?=$model->belong?></p>
                                    		<p ><span class="	glyphicon glyphicon-ok-sign"></span> <b>รับสมัครจำนวน  : </b><?=$model->number?> ตำแหน่ง</p>
                                                    		<b><span class="glyphicon glyphicon-list-alt"></span> รายละเอียด</b>
                                                    	
                                                    		<p><?= Yii::$app->formatter->asNtext($model->description)?></p>
                                                    		
                                                    		<br><p><span class="glyphicon glyphicon-time"></span><b> เวลาทำงาน : </b><?=Yii::$app->formatter->asTime($model->time_begin,'short')?> 
                                                    					ถึง <?=Yii::$app->formatter->asTime($model->time_end,'short')?>
                                                    		</p>
                                                    		<hr>
                                                    	
                                                    		
                                                    		<p><span class="glyphicon glyphicon-check"></span> <b> สวัสดิการ  </b></p>	
                                                    		<p>	 <?= Yii::$app->formatter->asNtext($model->benefits)?></p>	
                                                    		<!-- <p><span class="glyphicon glyphicon-object-align-bottom"></span><b> คุณสมบัติ </b></p> -->
                                                    	
                                                    			<hr>
                                                    		<p><span class="glyphicon glyphicon-usd"></span> <b> รายได้ : </b>
                                                    				<?= ($model->money2 ==NULL ? $model->money1: ($model->money1." - ".$model->money2))  ?> บาท
                                                    		 </p>
                                                    		 <p><span class="glyphicon glyphicon-earphone"></span> <b>โทร : </b> <?=$model->tel?></p>
                                                    		 <p><span class="glyphicon glyphicon-map-marker"></span> <b>ที่ตั้ง : </b><?=$model->address->nameAddress?></p>
                                                    		<hr>
            												<div class="form-group pull-right">
            														<?php //Html::a('สมัคร','join/join',['class'=>'btn btn-warning glyphicon'])?>
            														<?php 
            														
            														if (Yii::$app->user->isGuest ||  Yii::$app->user->can('public_relations')){?>
            														      <button class="btn btn-warning" disabled  title="สมัครงาน">สมัคร <span class="glyphicon glyphicon-check"></span></button>
            														 <?php  }else{?>
                														 	<?php $check = Joinwork::findOne(['user_id'=>Yii::$app->user->id,'work_id'=>$model->id]);?>
                														 	<?php if ($check ==NULL ){?>
                														 	    
                														 	<!-- Trigger the modal with a button -->
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?=$model->id?>"> สมัคร  <span class="glyphicon glyphicon-check"></span></button>
                                                                            
                                                                            <!-- Modal -->
                                                                            <div class="row">
                                                                            	<div class="col-md-3">
                                                                            	<div id="<?=$model->id?>" class="modal fade" role="dialog">
                                                                              <div class="modal-dialog">
                                                                            
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                  
                                                                                  <div class="modal-body">
                                                                                    <h3 class="text-center">ยืนยันการสมัคร</h3>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-3">
                                                                                    <a class="btn btn-success btn-lg btn-block " href="/joinwork/register?id=<?=$model->id?>" >   <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</a>
                                                                                  
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
                                                                            </div>
                														 	<?php }else {?>
                														 	<button  class="btn btn-warning" disabled  title="สมัครงาน">สมัครแล้ว <span class="glyphicon glyphicon-check"></span></button>
                															
            														<?php }}?>
            												</div>
                                   </div></div>
            					</div><!-- end body -->
                </div>
 </div>

