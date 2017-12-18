<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use common\models\Belong;
use common\models\Joinwork;

$this ->registerJs('
       function loadWork(id){
            $.ajax({
                    url : " '.Url::toRoute("/work/work-search-view?id=").' "+id,
                    method : "GET",
            }).done( function (txt) {
                 $("#data").html(txt);
            })
            return false;
        }
  function listProvinces(){
    var geo_id = $("#geo_id").val();
    $.ajax({
        url:" '.Url::toRoute("/address/list_provinces?id=").' ",
        method: "GET",
         data: { id: geo_id }
    }).done(function(txt){
        $("#province_id").html(txt);
    });
    
    }
    function listAmphures(){
    var province_id = $("#province_id").val();
    $.ajax({
        url:"'.Url::toRoute("/address/list_amphures").'",
        method: "GET",
         data: { id: province_id }
    }).done(function(txt){
        $("#amphur_id").html(txt);
    });
    
    }
    
function listDistricts(){
    var amphur_id = $("#amphur_id").val();
    $.ajax({
        url:"'.Url::toRoute("/address/list_districts").'",
        method: "GET",
         data: { id: amphur_id }
    }).done(function(txt){
        $("#district_id").html(txt);
    });
    
    }
    
',View::POS_END);
$this->title = "ค้นหางาน";
?>
<style>

.panel-body1 {
background: 	#04859D	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
th {
background: 	#009999	;
color : #FFFFFF;
}
panel-body3{
        background: 	#1D7373	;
        color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
       /* color:#FFFFFF; */
}
.panel-body2 {
background: 	#DCDCDC	;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);

} 
.panel-body3{
background: #01939A;
color: #FFFFFF;

box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
}
</style>
<div class="panel panel-default">
			
  <div class="panel-body panel-body3 ">
  		<h3 class="text-center"><b><img class="center" alt="" src="/img/logo.png" style="width:4%;  ">  ค้นหาโดย<u>เรียงลำดับสวัสดิการ</u></b></h3>
  </div>		<!-- end panel body -->
</div>	<!-- end panel -->


<?php   Pjax::begin([
		'enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> 
<div class="panel panel-default">
			
  <div class="panel-body panel-body1 ">
	<h3>ค้นหาตามความต้องการ</h3>
  <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
  		<div class="row">
  	
  					<div class="col-md-4">
          					  <?=$form->field($searchModel, 'description')->textInput(['placeholder'=>'คีย์เวิร์ดรายละเอียด เช่น สายงาน การทำงาน....'])?>
  					</div>
  					<div class="col-md-2">	
  							<?=$form->field($searchModel, 'money1')->textInput(['placeholder'=>'รายได้  0 - 300000'])?>
          				
  					</div>

  					<div class="col-md-2">
          					<?php echo  $form->field($searchModel, 'belong')->dropDownList(
                			             ArrayHelper::map(Belong::find()->all(), 'name_belong', 'name_belong'),
                        			       [
                        			           'prompt' => 'หน่วยงาน',
                        			       ]
                        			       );
                              ?>
  					</div>
  						<div class="col-md-2"><br>
  							<a href="#demo" data-toggle="collapse" class="btn btn-default btn-block">ค้นหาเพิ่มเติม <span class="glyphicon glyphicon-triangle-bottom"></span></a>
  					
  					</div>  		
  					 <div class="col-md-2"><br>
  							 <?= Html::submitButton( 'ค้นหา <span class="glyphicon glyphicon-search"></span>' , ['class' => 'btn btn-warning btn-block']) ?>
  					</div>		
  		</div> <!-- end row -->
<div id="demo" class="collapse">
		<div class="row"  > 
			<div class="col-md-4">
          					 <?= $form->field($searchModel, 'name_office')->textInput(
                                       ['maxlength' => true,'placeholder'=>'ชื่อสถานที่ทำงาน...']
          					     );
                                   
                            ?>
  					</div>
  				<div class="col-md-4">
  					
  					<?=$form->field($searchModel, 'benefits')->textInput(['placeholder'=>'คีย์เวิร์ดเกี่ยวกับสวัสดิการ เช่น ที่พัก ค่าเดินทาง...'])?>
  							
  					</div>
       			<div class="col-md-3">
       			
       			</div>
       	</div> <!-- end row -->
       <div class="row"  > 
  					<div class="col-md-2">
  					
  							<?= $form->field($searchModel, 'geo_id')->dropDownList(ArrayHelper::map(Geography::find()->all(), 'GEO_ID', 'GEO_NAME'),
                            		[
                            				'id' => 'geo_id',
                            				'prompt' => 'ภาค',
                            		        'onChange'=>'listProvinces()'
                            		]) ?>
  					</div>
  					<div class="col-md-2">
  							 <?= $form->field($searchModel, 'province_id')->
                            dropDownList([],    
                            		[
                            				'id' => 'province_id',
                            				'prompt' => 'จังหวัด',
                            		        'onChange'=>'listAmphures()'
                            		]) ?>
  					</div>
  					<div class="col-md-2">
  								<?= $form->field($searchModel, 'amphur_id')->
                            dropDownList([],
                            		[
                            				'id' => 'amphur_id',
                            				'prompt' => 'อำเภอ ',
                            		        'onChange'=>'listDistricts()'
                            		]) ?>
  					</div>
  					<div class="col-md-2">
  							<?= $form->field($searchModel, 'district_id')->
                            dropDownList([],
                            		[
                            				'id' => 'district_id',
                            				'prompt' => 'ตำบล',
                            		        'onChanged'=>'alert(this.val())',
                            		]) ?>
  					</div>
  					
  					
  		
  					</div>
  	 </div> 
</div> <!-- end collapsible -->
  		<?php \yii\widgets\ActiveForm::end(); ?>
  	
  </div>		<!-- end panel body -->

<div class="row">
		
			<div class="col-md-9">
			    <?php if ( $count == 0){?>   <!-- alert เมื่อ ไม่มีประกาศ-->
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong><span class="	glyphicon glyphicon-remove"></span> ไม่พบการประกาศงาน</strong>
    </div>
   <?php  }?>
    		</div>	
			<div class="col-md-3">
			<div class="pull-right">
					<h4>มุมมอง : 
                    <a href="/work/work-search-benefits" title="มุมมองแบบกว้าง "class="btn btn-default"><span class="	glyphicon glyphicon-list"></span></a>
                    	<a href="/work/work-search-benefits-list" title="มุมมองแบบ list"  class="btn btn-default"><span class="	glyphicon glyphicon-align-justify"></span></a>
                    </h4> 	
			</div>
			</div>
</div>

<div class="row">
			<table class="table table-striped table-hover table-bordered">
					<thead>
					<th>ลำดับ</th><th>ชื่อสถานที่ทำงาน</th><th>จังหวัด</th><th>รายละเอียด</th><th>รายได้</th><th>หน่วยงาน</th><th>เวลาประกาศ</th><th></th>
					</thead>
					<tbody>
					  <?php $number=0?>
                                             <?php foreach ($dataProvider->models as $data) :?>
							<tr>
								<td><?= ++$number;?></td>
								<td><?=$data->name_office?></td>
								<td> <?=$data->address->province_name?></td>
								<td><?php  $str= $data->description ;
                                              					if (strlen($str) > 150) echo '<p>'.(substr("$str", 0, 150)."...").'</p>';
                                              				                  	else echo '<p>'.$data->description.'</p>';
                                           ?>
                                </td>
								<td><?=$data->money1?> - <?=$data->money2?></td>
								<td><?=$data->belong    ?></td>
								<td><?=Yii::$app->formatter->asDate($data->work_created_at,'d MMM yyyy kk:mm')?></td>
								<td><button class="btn btn-info" data-toggle="modal" data-target="#<?=$data->id?>">เพิ่มเติม</button> 
								 <?php 
								 if (Yii::$app->user->isGuest||  Yii::$app->user->can('public_relations')){?>
                                            		 <button class="btn btn-warning" disabled  title="สมัครงาน">สมัคร <span class="glyphicon glyphicon-check"></span></button>
                                            <?php  }else{?>
                                            <?php $check = Joinwork::findOne(['user_id'=>Yii::$app->user->id,'work_id'=>$data->id]);?>
                                             <?php if ($check ==NULL){?>
                                                		 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?=$data->name_office?>"> สมัคร  <span class="glyphicon glyphicon-check"></span></button>
                                                                            
                                                                            <!-- Modal -->
                                                                            <div class="row">
                                                                            	<div class="col-md-3">
                                                                            	<div id="<?=$data->name_office?>" class="modal fade" role="dialog">
                                                                              <div class="modal-dialog">
                                                                            
                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">
                                                                                  
                                                                                  <div class="modal-body">
                                                                                    <h3 class="text-center">ยืนยันการสมัคร</h3>
                                                                                    <div class="row">
                                                                                    <div class="col-md-3"></div>
                                                                                    <div class="col-md-3">
                                                                                    <a class="btn btn-success btn-lg btn-block " href="/joinwork/register?id=<?=$data->id?>" >   <span class="	glyphicon glyphicon-ok-sign"></span> ตกลง</a>
                                                                                  
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
                                                <button class="btn btn-warning" disabled title="สมัครงาน">สมัครแล้ว <span class="glyphicon glyphicon-check"></span></button>
                                                															
                                            <?php }}?>	
								</td>
									
							</tr>
							
                                <div id="<?=$data->id?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <?php  $count_join = Joinwork::find()->where(['work_id'=>$data->id])->count();?>
                                        <h4 class="modal-title"><span class="label label-info glyphicon glyphicon-user">จำนวนผู้สมัคร : <?=$count_join?> </span> </h4>
                                      </div>
                                      <div class="modal-body">
                                                                              <div class="row">
                                										<div class="col-md-1"></div>
                                										<div class="col-md-10">
                                                                      		<h4 class="text-center"><span class="glyphicon glyphicon-home"></span> <?=$data->name_office?></h4>
                                                                    		<h5 class="text-center">
                                                                    		<span class="glyphicon glyphicon-map-marker"></span> <?=$data->address->province_name?><br><br>
                                                                    		<span class="glyphicon glyphicon-calendar"> ประกาศเมื่อ : วันที่ <?=Yii::$app->formatter->asDatetime($data->work_created_at,'d MMM yyyy kk:mm')?></span>
                                                                    		
                                                                    		</h5>
                                                                    		<p ><span class="glyphicon glyphicon-pushpin"></span> <b>หน่วยงาน  : </b><?=$data->belong?></p>
                                                                    		<p ><span class="	glyphicon glyphicon-ok-sign"></span> <b>รับสมัครจำนวน  : </b><?=$data->number?> ตำแหน่ง</p>
                                                                                    		<b><span class="glyphicon glyphicon-list-alt"></span> รายละเอียด</b>
                                                                                    	
                                                                                    		<p><?= Yii::$app->formatter->asNtext($data->description)?></p>
                                                                                    		
                                                                                    		<br><p><span class="glyphicon glyphicon-time"></span><b> เวลาทำงาน : </b><?=Yii::$app->formatter->asTime($data->time_begin,'short')?> 
                                                                                    					ถึง <?=Yii::$app->formatter->asTime($data->time_end,'short')?>
                                                                                    		</p>
                                                                                    		<hr>
                                                                                    	
                                                                                    		
                                                                                    		<p><span class="glyphicon glyphicon-check"></span> <b> สวัสดิการ  </b></p>	
                                                                                    		<p>	 <?= Yii::$app->formatter->asNtext($data->benefits)?></p>	
                                                                                    		<!-- <p><span class="glyphicon glyphicon-object-align-bottom"></span><b> คุณสมบัติ </b></p> -->
                                                                                    		
                                                                                    			<hr>
                                                                                    		<p><span class="glyphicon glyphicon-usd"></span> <b> รายได้ : </b>
                                                                                    				<?= ($data->money2 ==NULL ? $data->money1: ($data->money1." - ".$data->money2))  ?> บาท
                                                                                    		 </p>
                                                                                    		 <p><span class="glyphicon glyphicon-earphone"></span> <b>โทร : </b> <?=$data->tel?></p>
                                                                                    		 <p><span class="glyphicon glyphicon-map-marker"></span> <b>ที่ตั้ง : </b><?=$data->address->nameAddress?></p>
                                                                                    
                                
                                                                   </div></div>
                                      </div>
                                      <div class="modal-footer">
                                      <?php 
                                      if (Yii::$app->user->isGuest||  Yii::$app->user->can('public_relations')){?>
                                            		 <button class="btn btn-warning" disabled  title="สมัครงาน">สมัคร <span class="glyphicon glyphicon-check"></span></button>
                                            <?php  }else{?>
                                            <?php $check = Joinwork::findOne(['user_id'=>Yii::$app->user->id,'work_id'=>$data->id]);?>
                                             <?php if ($check ==NULL){?>
                                                	<a class="btn btn-warning" href="/joinwork/register?id=<?=$data->id?>" title="สมัครงาน" onclick="confirm('ยืนยันการสมัคร')">สมัคร <span class="glyphicon glyphicon-check"></span></a>
                                             <?php }else {?>
                                                <button class="btn btn-warning" disabled title="สมัครงาน">สมัครแล้ว <span class="glyphicon glyphicon-check"></span></button>
                                                															
                                            <?php }}?>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                      </div>
                                    </div>
                                
                                  </div>
                                </div>
							  <?php endforeach;?>
					</tbody>
			</table>
			
</div>
<?php Pjax::end();?>