<?php
use common\models\Joinwork;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'รายการสมัคร';
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

</div>
<?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> 	
 <div class="row">
<?php $form = ActiveForm::begin(); ?>
					<div class="col-md-6"></div>
					<div class="col-md-3">   <?= $form->field($searchModel, 'name_work')->textInput(['placeholder'=>'ชื่อสำนักงาน']) ?></div>
					<div class="col-md-2">
					
					    <?=$form->field($searchModel, 'join_status')->dropdownList([
					        Joinwork::STATUS_WAIT => 'ราการยืนยัน',
					        Joinwork::STATUS_ACTION=> 'อยู่ไหนการทำงาน',
					        Joinwork::STATUS_SUCCESS => 'เสร็จสิ้น'
                                ],
                                ['prompt'=>'สถานะการสมัคร']
                            );?>
					    </div>
					<div class="col-md-1"> 
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
        <th class="text-center">สถานนะ</th>
        <th style ="width:17%"></th>
      </tr>
    </thead>
    <tbody>
    <?php $count=0; foreach ($dataProvider->models as $data):?>
    <?php if ($data->user_id == Yii::$app->user->id){?>
      <tr>
      <td class="text-center"><?=++$count?></td>
        <td><?=$data->work->name_office?></td>
        <td><?=$data->user->fullname?></td>
        <td><?=Yii::$app->formatter->asDatetime($data->join_created_at)?></td>
        <td class="text-center"><?php   if ($data->join_status == Joinwork::STATUS_WAIT ) {
                 	                            echo  '<span class="label label-warning">รอการยืนยัน</span>';
        }else if ($data->join_status == Joinwork::STATUS_ACTION){
                 	                            echo  '<span class="label label-success">อยู่ในการทำงาน</span>';
                 	              }else echo  '<span class="label label-danger">เสร็จสิ้น</span>';?>
        </td>
        <td class="text-center">
       
        <?= Html::a(' ','/work/view?id='.$data->work_id, [
                 	                                    'class'=>'btn btn-info     glyphicon glyphicon-eye-open',
                 	                                    'title'=>'ดูรายละเอียด'
                 	                                ]);?>
	   	                                
        <?php if ($data->join_status == Joinwork::STATUS_SUCCESS && $data->join_status == Joinwork::STATUS_ACTION){?>
        <button type="button" class="btn btn-danger " disabled ><span class=" glyphicon glyphicon-trash"></span></button>
                          <?php   }else{?>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?=$data->join_created_at?>"><span class=" glyphicon glyphicon-trash"></span></button>
                                                                            
                                                                            <!-- Modal -->
                                                                            <div class="row">
                                                                            	<div class="col-md-3">
                                                                            	<div id="<?=$data->join_created_at?>" class="modal fade" role="dialog">
                                                                              <div class="modal-dialog">
                                                                            
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                  
                                                                                  <div class="modal-body">
                                                                                    <h3 class="text-center">ยืนยันการการลบ</h3>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-3">
                                                                                    <a class="btn btn-success btn-lg btn-block " href="/joinwork/delete2?id=<?=$data->id?>" >   <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</a>
                                                                                  
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
                  <?php }?>                        
        </td>
     </tr>
	<?php }?>
     <?php endforeach;?>
    </tbody>
  </table>



<div class="col-md-1"></div>
<?php Pjax::end(); ?>
