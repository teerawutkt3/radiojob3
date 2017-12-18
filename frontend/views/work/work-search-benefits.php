<?php

use kartik\range\RangeInput;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use common\models\Belong;

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
			<div class="panel panel-defualt">
					
                  <div class="panel-body panel-body2">
                			<div class="col-md-4">
                			  				<div class="panel-body panel-body3 ">
                                              		<p class="text-center">ประกาศ</p>
                                              </div>		<!-- end panel body -->
                                             <!-- list group -->
                                             <div class="list-group" style="height:600px; overflow:auto"	>
                                             <?php $number=0?>
                                             <?php foreach ($dataProvider->models as $data) :?>
                                              <a href="#" class="hover list-group-item" style=" text-decoration:none;" onclick="return loadWork(<?= $data->id?>)">
                                              			<?php $number+=1;?>
                                              			<?= $number.".  "?><span class="glyphicon glyphicon-home"> </span> <?=$data->name_office?>
                                              			
                                              					<?php  $str= $data->description ;
                                              					if (strlen($str) > 99) echo '<p>'.(substr("$str", 0, 99)."...").'</p>';
                                              				                  	else echo '<p>'.$data->description.'</p>';
                                              					?>
                                              			
                                              			<span class="glyphicon glyphicon-map-marker"></span> <?=$data->address->nameAddress?>
                                              			<br><b>หน่วยงาน  : </b><?=$data->belong    ?>
                                              		
                                              			<br><b>จำนวน  : </b><?=($data->number==null ?  "ไม่ได้ระบุ" : $data->number)   ?> ตำแหน่ง
                                              			<br><b><span class="glyphicon glyphicon-usd"></span>  : </b><?=$data->money1?> - <?=$data->money2?>
                                            			<span class="badge glyphicon glyphicon-hand-right"> เพิ่มเติม</span> 
                                            </a> 
                                             <?php endforeach;?>
                                             </div>
                                              
                           
                           
                           </div>
                			<div class="col-md-8" id="data"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                					<h1  class="text-center">แสดงรายละเอียดงาน</h1>
                			</div>
                		</div>
                </div>
</div>
<?php Pjax::end();?>