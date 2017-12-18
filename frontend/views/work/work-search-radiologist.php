<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use common\models\Joinwork;
use common\models\AuthAssignment;

$this->title = "ค้นหานักรังสีเทคนืค";
$this->params['breadcrumbs'][] = $this->title;

$this ->registerJs('

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
?>
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


<div class="panel panel-default">
			
  <div class="panel-body panel-body3 ">
  		<h3 class="text-center"><b><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> ค้นหา นักรังสีเทคนิค</b></h3>
  </div>		<!-- end panel body -->
</div>	<!-- end panel -->
<div class="panel panel-default">
			
  <div class="panel-body panel-body1 ">

  <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
  		<div class="row">
  	
  					<div class="col-md-3">
          					 <?= $form->field($searchModel, 'fname')->textInput(
                                       ['maxlength' => true,'placeholder'=>'ชื่อ']
          					     );
                                   
                            ?>
  					</div>
  					<div class="col-md-3">	
  							<?=$form->field($searchModel, 'lname')->textInput(['placeholder'=>'นามสกุล'])?>
          					<?php /* echo  $form->field($searchModel, 'money1')->widget(
                      		    RangeInput::className(),
                      		    [
                      		      //  'name' => 'description',
                      		        'attribute' => 'money1',
                      		        'options' => ['placeholder' => '0 - 130000...'],
                      		        'html5Options' => ['min' => 0, 'max' => 130000],
                      		        'addon' => ['append' => ['content' => 'บาท']]
                      		    ] ) */
                      		?>
  					</div>
							
  					
  		</div><label>ที่อยู่ของนักรังสี</label>
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
  					<div class="col-md-2">
  								
  					</div>
  					<div class="col-md-2">
  					 <div class="form-group"><br>
                                      
                                             <?= Html::submitButton( 'ค้นหา <span class="glyphicon glyphicon-search"></span>' , ['class' => 'btn btn-warning btn-block']) ?>
                                        </div>
  					</div>
  					
  	 </div> 
  	 <div class="row"> 
  					
  					<div class="col-md-2 pull-right">
  								        
  					</div>
  	 </div> 
  		<?php \yii\widgets\ActiveForm::end(); ?>
  	
  </div>		<!-- end panel body -->
</div>	<!-- end panel -->

 <?php if ( $count == 0){?>   <!-- alert เมื่อ ไม่มีประกาศ-->
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><span class="	glyphicon glyphicon-remove"></span> ไม่พบนักรังสี</strong>
                </div>
               <?php  }?>    				
<table class="table table-striped table-hover">
  <tr>
    <th>ลำดับ</th>
    <th>ชื่อ - นามสกุล</th>
    <th>จังหวัด</th>
    <th>เริ่มใช้งานเมื่อ</th>
    <th>การร่วมงาน</th>
    <th></th>
  </tr>
  <?php $count=0; foreach ($dataProvider->models as $data):?>
  <?php $auth = AuthAssignment::find()->where(['user_id'=>$data->id,'item_name'=>'radiologist'])->one()?>
  <?php if ($auth != null){?>
  <?php if ($auth->user_id == $data->id){?>
  <tr>
    <td><?=++$count?></td>
    <td><?=$data->fullName?></td>
    <td><?=($data->address_id != null?$data->address->province_name:"")?></td>
     <td><?=Yii::$app->formatter->asDatetime($data->created_at)?></td>
    <td>
    	
    	<?php $check_join_work = Joinwork::find()->where([ 'created_work'=> Yii::$app->user->id,'user_id'=>$data->id,'join_status'=>Joinwork::STATUS_SUCCESS])->one();
    	
    	   if ($check_join_work == null || !$check_join_work) echo '<span class="label label-default">ไม่เคยร่วมงาน</span>';
    	   else echo '<span class="label label-success">เคยร่วมงาน</span>';
    	?>
    </td>
    <td>
    	<div class="pull-right">
        <?=Html::a('เชิญชวนมาทำงาน','/letter/send?touserid='.$data->id,['class'=>'btn btn-success'])?>
        <?=Html::a('ดูโปรไฟล์','/user/view?id='.$data->id,['class'=>'btn btn-info'])?>
        </div>
    </td>
  </tr>
  <?php }else{}}else{}?>
  <?php endforeach;?>
</table>









<?php Pjax::end()?>