<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbox';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>
<div class="messages-index">
    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> <?= Html::encode($this->title) ?></h3></div>
    </div>

		   <?php $form = ActiveForm::begin(); ?>
				<div class="row">
				<div class="col-md-6"><br>	
				<?=Html::a('การตอบกลับ','/letter/index',['class'=>'btn btn-primary'])?>
					<?=Html::a('จดหมายที่ส่งแล้ว','/letter/send-total',['class'=>'btn btn-success'])?>
				</div>
					<div class="col-md-5">
					<?= $form->field($searchModel, 'nameSearch')->textInput(['maxlength' => true,'placeholder'=> 'ค้นหาผู้ส่ง']) ?>
					</div>
					<div class="col-md-1"><br>
					<?=Html::submitButton('ค้นหา',['class'=>'btn btn-warning'])?>
					</div>
				</div>
				
				
			 <?php ActiveForm::end(); ?>	
			
	<table class="table table-striped table-hover"  style=" overflow:auto"> 
		<tbody >
		
			<tr>
				<th class="text-center">ลำดับ</th>
				<th class="text-center">รายละเอียด</th>
				<th >ผู้ส่ง</th>
				<th >ผู้รับ</th>
				<th >ส่งเมื่อ</th>
				<th class="text-center"></th>
			</tr>
			<?php $count=0;  foreach ($dataProvider->models as $data):?>
			<tr>
				<td class="text-center"><?=++$count?></td>
				<td class="text-center">
				<button type="button" class="btn btn-info " data-toggle="modal" data-target="#<?=$data->id?>">รายละเอียด</button>

                    <!-- Modal -->
                    <div id="<?=$data->id?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">รายละเอียด</h4>
                          </div>
                          <div class="modal-body">
                            <p><?=Yii::$app->formatter->asNtext($data->description)?></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                          </div>
                        </div>
                    
                      </div>
                    </div><!-- end Modal -->
				</td>
				<td><?=$data->user->fullname?><br><?=$data->user->email ?></td>
				<td><?=$data->userto->fullname?></td>
				<td><?=Yii::$app->formatter->asDatetime($data->message_created_at)?></td>
				<td class="text-center">
				<?=Html::a('ตอบกลับ','/letter/send?touserid='.$data->created_by_user_id,['class'=>'btn btn-success'])?>
				<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#<?=$data->description?>">
					<span class="glyphicon glyphicon-trash"></span>
				</button>

                    <!-- Modal -->
                    <div id="<?=$data->description?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-body">
                            <h3 class="text-center">ยืนยันการลบข้อความ</h3>
                                          <div class="row">
                                               <div class="col-md-3"></div>
                                               <div class="col-md-3">
                                                     <a class="btn btn-success btn-lg btn-block " href="/letter/delete?id=<?=$data->id?>" >   
                                                      <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</a>
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
                    </div><!-- end Modal -->
				</td>
			</tr>
			<?php endforeach;?>
			
		</tbody>
	</table>
    
</div>