<?php



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
                                                    		
                                   </div></div>
            					</div><!-- end body -->
                </div>
 </div>

