<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use kartik\label\LabelInPlace;
use common\models\Belong;
use kartik\range\RangeInput;
use yii\helpers\Url;
use yii\widgets\Pjax;
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
    
',\yii\web\View::POS_END);
$this->title = "ค้นหางาน";
?>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk&language=th&libraries=places"></script> -->
	
<style>

.panel-body1 {
background: 	#04859D	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
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
<?php   Pjax::begin([
		'enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> 
<?php 

$coord = new LatLng(['lat'=>13.777234,'lng'=>100.561981]);
$map = new Map([
    'center'=>$coord,
    'zoom'=>6,
    'width'=>'100%',
    'height'=>'600',
]);
foreach($dataProvider->models as $data):
    $coords = new LatLng(['lat'=>$data->address->lat,'lng'=>$data->address->long]);
    $marker = new Marker(['position'=>$coords]);
    $marker->attachInfoWindow(
        new InfoWindow([
            'content'=>'

                  <h4>'.$data->name_office.'</h4><hr>
                 <p>ที่อยู่ '.$data->address->nameAddress.'</p>
                  <p>ประกาศเมื่อ '.Yii::$app->formatter->asDatetime($data->work_created_at).'</p>


            <button type="button" title="ดูรายละเอียดเพิ่มเติม" class="btn btn-info " data-toggle="modal" data-target="#'.$data->id.'">เพิ่มเติม</button>
            <a href="/work/google-directions?lat='.$data->address->lat.'&long='.$data->address->long.'&name_office='.$data->name_office.'    " class="btn btn-warning"><span class="	glyphicon glyphicon-flag"></span> นำทาง</a>
        '
        ])
        );
    
    $map->addOverlay($marker);
    ?>
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
<?php endforeach;
?>
<div class="panel panel-default">
			
  <div class="panel-body panel-body3 ">
  		<h3 class="text-center"><b><span class="glyphicon glyphicon-search"></span> ค้นหาด้วย Google Map</b></h3>
  </div>		<!-- end panel body -->
</div>	<!-- end panel -->
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

    <?php if ( $count == 0){?>   <!-- alert เมื่อ ไม่มีประกาศ-->
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong><span class="	glyphicon glyphicon-remove"></span> ไม่พบการประกาศงาน</strong>
    </div>
   <?php  }?>
<div class="panel panel-info">
    <div class="panel-heading">
    <div class="row">
    	<div class="col-md-10 col-xs-6"><h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> ค้นหางานจาก Google Map</h3></div>
    	<div class="col-md-2 col-xs-6"><a href="/work/work-search-map" class="btn btn-danger pull-right">Refresh  Map <span class="	glyphicon glyphicon-repeat"></span></a></div>
    </div>
    </div>

    <div class="panel-body">
        <?php
        echo $map->display();
        ?>
    </div>
</div>
<?php Pjax::end();?>


